<?php
use ImportVocab\ImportVocab;

/**
 * login validator.
 *
 * @package    Registry
 * @subpackage import
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: myLoginValidator.class.php 2 2006-04-03 21:07:20Z jphipps $
 */
class myImportValidator extends sfValidator
{
    public function initialize($context, $parameters = null)
    {

        // initialize parent
        parent::initialize($context);

        // set defaults
        $this->getParameterHolder()->set('import_error', 'Invalid CSV');

        $this->getParameterHolder()->add($parameters);

        return true;
    }

    /**
     * Execute this validator.
     *
     * @param mixed A file or parameter value/array.
     * @param error An error message reference.
     *
     * @return bool true, if this validator executes successfully, otherwise
     *              false.
     */
    public function execute(&$value, &$error)
    {
        $request = $this->getContext()->getRequest();
        $schemaId = $request->getParameter('schema_id');
        if (!$schemaId) {
            $error = "There is no Schema ID in your request";

            return false;
        }
        $fileName = $value['tmp_name'];

        $filePath = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR . $fileName;
        $import = new ImportVocab('schema', $filePath, $schemaId);
        $prolog = $import->processProlog();
        //check to make sure that if there's a schema_id in the prolog that it matches the current ID
        if (isset($prolog['meta']['schema_id'])) {
            if (is_array($prolog['meta']['schema_id'])) {
                $error = "You have a duplicate of one of the prolog columns ('reg_id', 'uri', 'type') in your data";

                return false;
            }
            if ($prolog['meta']['schema_id'] != $schemaId) {
                $error = 'The Schema Id in the file you are importing does not match the Schema Id of this
        Element Set';

                return false;
            }
        }
        //check to make sure the user is an admin
        /** @var myUser $user */
        $user = $this->getContext()->getUser();
        if ( ! $user->hasCredential(array(
              0 => array(
                    0 => 'administrator',
                    1 => 'schemaadmin',
              ),
        ))
        ) {
            $error = 'You must be an administrator of this Element Set to import.';

            return false;
        }

        //return true;









       $currentFile = sfConfig::get('sf_upload_dir') . "/csv/" . $value['name'];
            if ( ! $request->hasErrors() && isset($file_import_history['filename_remove'])) {
                if (is_file($currentFile)) {
                    unlink($currentFile);
                }
            }

            if ( ! $request->hasErrors()
                 && $request
                         ->getFileSize('file_import_history[filename]')
            ) {
                $fileName =
                      md5($request->getFileName('file_import_history[filename]') . time() . rand(0, 99999));
                $ext = $request->getFileExtension('file_import_history[filename]');
                if (is_file($currentFile)) {
                    unlink($currentFile);
                }
                $request
                     ->moveFile('file_import_history[filename]',
                           sfConfig::get('sf_upload_dir') . "/csv/" . $fileName . $ext);
                $this->file_import_history->setFilename($fileName . $ext);
            }
        }


}

