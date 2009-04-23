<?php
// test variables definition
define('TEST_CLASS', 'Post');

// initializes testing framework
$sf_root_dir = realpath(dirname(__FILE__).'/../../../../');
$apps_dir = glob($sf_root_dir.'/apps/*', GLOB_ONLYDIR);
$app = substr($apps_dir[0],
              strrpos($apps_dir[0], DIRECTORY_SEPARATOR) + 1,
              strlen($apps_dir[0]));
if (!$app)
{
  throw new Exception('No app has been detected in this project');
}

// initialize database manager
require_once($sf_root_dir.'/test/bootstrap/unit.php');

if (SYMFONY_VERSION >= 1.1)
{
  $configuration = ProjectConfiguration::getApplicationConfiguration($app, 'test', true);
  $databaseManager = new sfDatabaseManager($configuration);
}
else
{
  // initialize database manager
  require_once($sf_root_dir.'/test/bootstrap/functional.php');
  require_once($sf_symfony_lib_dir.'/vendor/lime/lime.php');

  $databaseManager = new sfDatabaseManager();
  $databaseManager->initialize();
  $con = Propel::getConnection();
}

if (!defined('TEST_CLASS') || !class_exists(TEST_CLASS))
{
  // Don't run tests
  return;
}
// clean the database
sfCommentPeer::doDeleteAll();
call_user_func(array(_create_object()->getPeer(), 'doDeleteAll'));

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

// start tests
$t = new lime_test(11, new lime_output_color());


// these tests check for the comments attachement consistency
$t->diag('comments attachment consistency');

$object1 = _create_object();
$t->ok($object1->getComments() == array(), 'a new object has no comment.');
$object1->save();

$object1->addComment('<p>One first comment.</p>');
$object_comments = $object1->getComments();
$t->ok((count($object_comments) == 1) && ($object_comments[0]['Text'] == '<p>One first comment.</p>'), 'a saved object can get commented.');

$object1->addComment('One second comment.');
$t->ok($object1->getNbComments() == 2, 'one object can have several comments.');

$object2 = _create_object();
$object2->save();

$object2->addComment('One first comment on object2.');
$object1_comments = $object1->getComments();
$object2_comments = $object2->getComments();
$t->ok((count($object1_comments) == 2) && (count($object2_comments) == 1), 'one comment is only attached to one Propel object.');
$t->ok(count($object1_comments) == $object1->getNbComments(), 'getNbComment() permùits to retrieve one object\'s comments number.');

$object3 = _create_object();
$object3->save();
$comment1 = array('text'         => 'One first comment',
                  'author_name'  => 'Gérard',
                  'author_email' => 'gerard@lambert.com');
$object3->addComment($comment1);
$t->ok($object3->getNbComments() == 1, 'comments can also be attached using arrays.');
$comment2 = array('text'         => 'My Back-office comment',
                  'author_name'  => 'Gérard',
                  'author_email' => 'gerard@lambert.com',
                  'namespace'    => 'backend');
$object3->addComment($comment2);
$object3->addComment($comment2);
$t->ok(($object3->getNbComments() == 3) && ($object3->getNbComments(array('namespace' => 'backend')) == 2), 'comments are separated into namespaces, and can be retrieved separately.');


// these tests check for other methods
$t->diag('comments manipulation methods');
sfCommentPeer::doDeleteAll();

$object1 = _create_object();
$object1->save();
$object1->addComment('One first comment.');
$object1->addComment('One second comment.');
$object_comments = $object1->getComments();
$nb_object_comments = $object1->getNbComments();
$t->ok(($nb_object_comments == count($object_comments)) && ($nb_object_comments == 2), 'getNbComments() returns the number of comments attached to the object when it has still not been saved.');

$object1->addComment('One third comment.');
$object_comments = $object1->getComments();
$nb_object_comments = $object1->getNbComments();
$t->ok(($nb_object_comments == count($object_comments)) && ($nb_object_comments == 3), 'getNbComments() returns the number of comments attached to the object, when it has been saved also.');

$object1->clearComments();
$t->ok($object1->getNbComments() === 0, 'comments on an object can be cleared using clearComments().');


// these tests check for comments retrieval methods
$t->diag('comments retrieval methods');
sfCommentPeer::doDeleteAll();

$object1 = _create_object();
$object1->save();
$object1->addComment('<p>One first comment.</p>');
$object1->addComment('<p>One second comment.</p>');
$asc_comments = $object1->getComments(array('order' => 'asc'));
$desc_comments = $object1->getComments(array('order' => 'desc'));
$t->ok(($asc_comments[0]['Text'] == '<p>One first comment.</p>')
       && ($asc_comments[1]['Text'] == '<p>One second comment.</p>')
       && ($desc_comments[1]['Text'] == '<p>One first comment.</p>')
       && ($desc_comments[0]['Text'] == '<p>One second comment.</p>'), 'comments can be retrieved in a specific order.');


// test object creation
function _create_object()
{
  $classname = TEST_CLASS;

  if (!class_exists($classname))
  {
    throw new Exception(sprintf('Unknow class "%s"', $classname));
  }


  return new $classname;
}