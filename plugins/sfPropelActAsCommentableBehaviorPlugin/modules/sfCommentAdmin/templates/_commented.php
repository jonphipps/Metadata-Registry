<?php
$model = $sf_comment->getCommentableModel();
$id = $sf_comment->getCommentableId();
$commented_object = sfPropelActAsCommentableToolkit::retrieveCommentableObject($model, $id);

if (in_array('getTitle', get_class_methods($commented_object)))
{
  $commented = $commented_object->getTitle();
}
elseif (in_array('getName', get_class_methods($commented_object)))
{
  $commented = $commented_object->getName();
}
elseif (in_array('toString', get_class_methods($commented_object)))
{
  $commented = $commented_object->toString();
}
else
{
  $commented = $model.' #'.$id;
}

if ('' == $commented)
{
  $commented = $model.' #'.$id;
}

echo $commented;