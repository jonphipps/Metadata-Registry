<?php

/**
 * Base class that represents a row from the 'users' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseUsers extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        UsersPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the created_at field.
	 * @var        int
	 */
	protected $created_at;


	/**
	 * The value for the updated_at field.
	 * @var        int
	 */
	protected $updated_at;


	/**
	 * The value for the deleted_at field.
	 * @var        int
	 */
	protected $deleted_at;


	/**
	 * The value for the last_updated field.
	 * @var        int
	 */
	protected $last_updated;


	/**
	 * The value for the nickname field.
	 * @var        string
	 */
	protected $nickname;


	/**
	 * The value for the salutation field.
	 * @var        string
	 */
	protected $salutation;


	/**
	 * The value for the first_name field.
	 * @var        string
	 */
	protected $first_name;


	/**
	 * The value for the last_name field.
	 * @var        string
	 */
	protected $last_name;


	/**
	 * The value for the email field.
	 * @var        string
	 */
	protected $email;


	/**
	 * The value for the sha1_password field.
	 * @var        string
	 */
	protected $sha1_password;


	/**
	 * The value for the salt field.
	 * @var        string
	 */
	protected $salt;


	/**
	 * The value for the want_to_be_moderator field.
	 * @var        boolean
	 */
	protected $want_to_be_moderator = false;


	/**
	 * The value for the is_moderator field.
	 * @var        boolean
	 */
	protected $is_moderator = false;


	/**
	 * The value for the is_administrator field.
	 * @var        boolean
	 */
	protected $is_administrator = false;


	/**
	 * The value for the deletions field.
	 * @var        int
	 */
	protected $deletions = 0;


	/**
	 * The value for the password field.
	 * @var        string
	 */
	protected $password;


	/**
	 * The value for the status field.
	 * @var        boolean
	 */
	protected $status = true;


	/**
	 * The value for the culture field.
	 * @var        string
	 */
	protected $culture = 'en_US';


	/**
	 * The value for the confirmation_code field.
	 * @var        string
	 */
	protected $confirmation_code = '';


	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name = '';


	/**
	 * The value for the confirmed field.
	 * @var        boolean
	 */
	protected $confirmed = false;


	/**
	 * The value for the remember_token field.
	 * @var        string
	 */
	protected $remember_token;

	/**
	 * Collection to store aggregation of collAssignedRoless.
	 * @var        array
	 */
	protected $collAssignedRoless;

	/**
	 * The criteria used to select the current contents of collAssignedRoless.
	 * @var        Criteria
	 */
	protected $lastAssignedRolesCriteria = null;

	/**
	 * Collection to store aggregation of collExportss.
	 * @var        array
	 */
	protected $collExportss;

	/**
	 * The criteria used to select the current contents of collExportss.
	 * @var        Criteria
	 */
	protected $lastExportsCriteria = null;

	/**
	 * Collection to store aggregation of collHistorys.
	 * @var        array
	 */
	protected $collHistorys;

	/**
	 * The criteria used to select the current contents of collHistorys.
	 * @var        Criteria
	 */
	protected $lastHistoryCriteria = null;

	/**
	 * Collection to store aggregation of collImportssRelatedByImportedBy.
	 * @var        array
	 */
	protected $collImportssRelatedByImportedBy;

	/**
	 * The criteria used to select the current contents of collImportssRelatedByImportedBy.
	 * @var        Criteria
	 */
	protected $lastImportsRelatedByImportedByCriteria = null;

	/**
	 * Collection to store aggregation of collImportssRelatedByUserId.
	 * @var        array
	 */
	protected $collImportssRelatedByUserId;

	/**
	 * The criteria used to select the current contents of collImportssRelatedByUserId.
	 * @var        Criteria
	 */
	protected $lastImportsRelatedByUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collProfilesRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collProfilesRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collProfilesRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastProfileRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collProfilesRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collProfilesRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collProfilesRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastProfileRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collProfilesRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collProfilesRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collProfilesRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastProfileRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collProfilesRelatedByChildUpdatedBy.
	 * @var        array
	 */
	protected $collProfilesRelatedByChildUpdatedBy;

	/**
	 * The criteria used to select the current contents of collProfilesRelatedByChildUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastProfileRelatedByChildUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collProfilePropertysRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collProfilePropertysRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collProfilePropertysRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastProfilePropertyRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collProfilePropertysRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collProfilePropertysRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collProfilePropertysRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastProfilePropertyRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collProfilePropertysRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collProfilePropertysRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collProfilePropertysRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastProfilePropertyRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collProjectUsers.
	 * @var        array
	 */
	protected $collProjectUsers;

	/**
	 * The criteria used to select the current contents of collProjectUsers.
	 * @var        Criteria
	 */
	protected $lastProjectUserCriteria = null;

	/**
	 * Collection to store aggregation of collProjectssRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collProjectssRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collProjectssRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastProjectsRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collProjectssRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collProjectssRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collProjectssRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastProjectsRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collProjectssRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collProjectssRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collProjectssRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastProjectsRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collAgentsRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collAgentsRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collAgentsRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastAgentRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collAgentsRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collAgentsRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collAgentsRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastAgentRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collAgentsRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collAgentsRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collAgentsRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastAgentRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collAgentHasUsers.
	 * @var        array
	 */
	protected $collAgentHasUsers;

	/**
	 * The criteria used to select the current contents of collAgentHasUsers.
	 * @var        Criteria
	 */
	protected $lastAgentHasUserCriteria = null;

	/**
	 * Collection to store aggregation of collCollectionsRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collCollectionsRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collCollectionsRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastCollectionRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collCollectionsRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collCollectionsRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collCollectionsRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastCollectionRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collCollectionsRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collCollectionsRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collCollectionsRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastCollectionRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collCollectionsRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collCollectionsRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collCollectionsRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastCollectionRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collCollectionsRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collCollectionsRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collCollectionsRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastCollectionRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collConceptsRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collConceptsRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collConceptsRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastConceptRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collConceptsRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collConceptsRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collConceptsRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastConceptRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collConceptsRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collConceptsRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collConceptsRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastConceptRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collConceptsRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collConceptsRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collConceptsRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastConceptRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collConceptsRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collConceptsRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collConceptsRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastConceptRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertysRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collConceptPropertysRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collConceptPropertysRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertysRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collConceptPropertysRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collConceptPropertysRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertysRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collConceptPropertysRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collConceptPropertysRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertysRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collConceptPropertysRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collConceptPropertysRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertysRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collConceptPropertysRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collConceptPropertysRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertyHistorysRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collConceptPropertyHistorysRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collConceptPropertyHistorysRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertyHistorysRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collConceptPropertyHistorysRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collConceptPropertyHistorysRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyHistoryRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collDiscusssRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collDiscusssRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collDiscusssRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastDiscussRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collDiscusssRelatedByDeletedUserId.
	 * @var        array
	 */
	protected $collDiscusssRelatedByDeletedUserId;

	/**
	 * The criteria used to select the current contents of collDiscusssRelatedByDeletedUserId.
	 * @var        Criteria
	 */
	protected $lastDiscussRelatedByDeletedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collDiscusssRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collDiscusssRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collDiscusssRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastDiscussRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collDiscusssRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collDiscusssRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collDiscusssRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastDiscussRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collExportHistorysRelatedByUserId.
	 * @var        array
	 */
	protected $collExportHistorysRelatedByUserId;

	/**
	 * The criteria used to select the current contents of collExportHistorysRelatedByUserId.
	 * @var        Criteria
	 */
	protected $lastExportHistoryRelatedByUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collExportHistorysRelatedByExportedBy.
	 * @var        array
	 */
	protected $collExportHistorysRelatedByExportedBy;

	/**
	 * The criteria used to select the current contents of collExportHistorysRelatedByExportedBy.
	 * @var        Criteria
	 */
	protected $lastExportHistoryRelatedByExportedByCriteria = null;

	/**
	 * Collection to store aggregation of collFileImportHistorysRelatedByUserId.
	 * @var        array
	 */
	protected $collFileImportHistorysRelatedByUserId;

	/**
	 * The criteria used to select the current contents of collFileImportHistorysRelatedByUserId.
	 * @var        Criteria
	 */
	protected $lastFileImportHistoryRelatedByUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collFileImportHistorysRelatedByImportedBy.
	 * @var        array
	 */
	protected $collFileImportHistorysRelatedByImportedBy;

	/**
	 * The criteria used to select the current contents of collFileImportHistorysRelatedByImportedBy.
	 * @var        Criteria
	 */
	protected $lastFileImportHistoryRelatedByImportedByCriteria = null;

	/**
	 * Collection to store aggregation of collSchemasRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collSchemasRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemasRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemasRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collSchemasRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemasRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemasRelatedByDeletedUserId.
	 * @var        array
	 */
	protected $collSchemasRelatedByDeletedUserId;

	/**
	 * The criteria used to select the current contents of collSchemasRelatedByDeletedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaRelatedByDeletedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemasRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collSchemasRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collSchemasRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastSchemaRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collSchemasRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collSchemasRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collSchemasRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastSchemaRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collSchemasRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collSchemasRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collSchemasRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastSchemaRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertysRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collSchemaPropertysRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertysRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertysRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collSchemaPropertysRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertysRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertysRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collSchemaPropertysRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collSchemaPropertysRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertysRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collSchemaPropertysRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collSchemaPropertysRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertysRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collSchemaPropertysRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collSchemaPropertysRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementsRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collSchemaPropertyElementsRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementsRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementsRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collSchemaPropertyElementsRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementsRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementsRelatedByDeletedUserId.
	 * @var        array
	 */
	protected $collSchemaPropertyElementsRelatedByDeletedUserId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementsRelatedByDeletedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementRelatedByDeletedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementsRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collSchemaPropertyElementsRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementsRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementsRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collSchemaPropertyElementsRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementsRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementsRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collSchemaPropertyElementsRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementsRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementHistorysRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collSchemaPropertyElementHistorysRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementHistorysRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementHistorysRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collSchemaPropertyElementHistorysRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementHistorysRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collVocabularysRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collVocabularysRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByDeletedUserId.
	 * @var        array
	 */
	protected $collVocabularysRelatedByDeletedUserId;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByDeletedUserId.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByDeletedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByChildUpdatedUserId.
	 * @var        array
	 */
	protected $collVocabularysRelatedByChildUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByChildUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByChildUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collVocabularysRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collVocabularysRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collVocabularysRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByChildUpdatedBy.
	 * @var        array
	 */
	protected $collVocabularysRelatedByChildUpdatedBy;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByChildUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByChildUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularyHasUsers.
	 * @var        array
	 */
	protected $collVocabularyHasUsers;

	/**
	 * The criteria used to select the current contents of collVocabularyHasUsers.
	 * @var        Criteria
	 */
	protected $lastVocabularyHasUserCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularyHasVersionsRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collVocabularyHasVersionsRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collVocabularyHasVersionsRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastVocabularyHasVersionRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularyHasVersionsRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collVocabularyHasVersionsRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collVocabularyHasVersionsRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastVocabularyHasVersionRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collRoleUsers.
	 * @var        array
	 */
	protected $collRoleUsers;

	/**
	 * The criteria used to select the current contents of collRoleUsers.
	 * @var        Criteria
	 */
	protected $lastRoleUserCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaHasUsers.
	 * @var        array
	 */
	protected $collSchemaHasUsers;

	/**
	 * The criteria used to select the current contents of collSchemaHasUsers.
	 * @var        Criteria
	 */
	protected $lastSchemaHasUserCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaHasVersionsRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collSchemaHasVersionsRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemaHasVersionsRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaHasVersionRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaHasVersionsRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collSchemaHasVersionsRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collSchemaHasVersionsRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastSchemaHasVersionRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collSocialLoginss.
	 * @var        array
	 */
	protected $collSocialLoginss;

	/**
	 * The criteria used to select the current contents of collSocialLoginss.
	 * @var        Criteria
	 */
	protected $lastSocialLoginsCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{

		return $this->id;
	}

	/**
	 * Get the [optionally formatted] [created_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [optionally formatted] [updated_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [optionally formatted] [deleted_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getDeletedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->deleted_at === null || $this->deleted_at === '') {
			return null;
		} elseif (!is_int($this->deleted_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->deleted_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [deleted_at] as date/time value: " . var_export($this->deleted_at, true));
			}
		} else {
			$ts = $this->deleted_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [optionally formatted] [last_updated] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getLastUpdated($format = 'Y-m-d H:i:s')
	{

		if ($this->last_updated === null || $this->last_updated === '') {
			return null;
		} elseif (!is_int($this->last_updated)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->last_updated);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [last_updated] as date/time value: " . var_export($this->last_updated, true));
			}
		} else {
			$ts = $this->last_updated;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [nickname] column value.
	 * 
	 * @return     string
	 */
	public function getNickname()
	{

		return $this->nickname;
	}

	/**
	 * Get the [salutation] column value.
	 * 
	 * @return     string
	 */
	public function getSalutation()
	{

		return $this->salutation;
	}

	/**
	 * Get the [first_name] column value.
	 * 
	 * @return     string
	 */
	public function getFirstName()
	{

		return $this->first_name;
	}

	/**
	 * Get the [last_name] column value.
	 * 
	 * @return     string
	 */
	public function getLastName()
	{

		return $this->last_name;
	}

	/**
	 * Get the [email] column value.
	 * 
	 * @return     string
	 */
	public function getEmail()
	{

		return $this->email;
	}

	/**
	 * Get the [sha1_password] column value.
	 * 
	 * @return     string
	 */
	public function getSha1Password()
	{

		return $this->sha1_password;
	}

	/**
	 * Get the [salt] column value.
	 * 
	 * @return     string
	 */
	public function getSalt()
	{

		return $this->salt;
	}

	/**
	 * Get the [want_to_be_moderator] column value.
	 * 
	 * @return     boolean
	 */
	public function getWantToBeModerator()
	{

		return $this->want_to_be_moderator;
	}

	/**
	 * Get the [is_moderator] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsModerator()
	{

		return $this->is_moderator;
	}

	/**
	 * Get the [is_administrator] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsAdministrator()
	{

		return $this->is_administrator;
	}

	/**
	 * Get the [deletions] column value.
	 * 
	 * @return     int
	 */
	public function getDeletions()
	{

		return $this->deletions;
	}

	/**
	 * Get the [password] column value.
	 * 
	 * @return     string
	 */
	public function getPassword()
	{

		return $this->password;
	}

	/**
	 * Get the [status] column value.
	 * 
	 * @return     boolean
	 */
	public function getStatus()
	{

		return $this->status;
	}

	/**
	 * Get the [culture] column value.
	 * 
	 * @return     string
	 */
	public function getCulture()
	{

		return $this->culture;
	}

	/**
	 * Get the [confirmation_code] column value.
	 * 
	 * @return     string
	 */
	public function getConfirmationCode()
	{

		return $this->confirmation_code;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{

		return $this->name;
	}

	/**
	 * Get the [confirmed] column value.
	 * 
	 * @return     boolean
	 */
	public function getConfirmed()
	{

		return $this->confirmed;
	}

	/**
	 * Get the [remember_token] column value.
	 * 
	 * @return     string
	 */
	public function getRememberToken()
	{

		return $this->remember_token;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = UsersPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [created_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = UsersPeer::CREATED_AT;
		}

	} // setCreatedAt()

	/**
	 * Set the value of [updated_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = UsersPeer::UPDATED_AT;
		}

	} // setUpdatedAt()

	/**
	 * Set the value of [deleted_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setDeletedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [deleted_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->deleted_at !== $ts) {
			$this->deleted_at = $ts;
			$this->modifiedColumns[] = UsersPeer::DELETED_AT;
		}

	} // setDeletedAt()

	/**
	 * Set the value of [last_updated] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setLastUpdated($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [last_updated] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_updated !== $ts) {
			$this->last_updated = $ts;
			$this->modifiedColumns[] = UsersPeer::LAST_UPDATED;
		}

	} // setLastUpdated()

	/**
	 * Set the value of [nickname] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setNickname($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nickname !== $v) {
			$this->nickname = $v;
			$this->modifiedColumns[] = UsersPeer::NICKNAME;
		}

	} // setNickname()

	/**
	 * Set the value of [salutation] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSalutation($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salutation !== $v) {
			$this->salutation = $v;
			$this->modifiedColumns[] = UsersPeer::SALUTATION;
		}

	} // setSalutation()

	/**
	 * Set the value of [first_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setFirstName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = UsersPeer::FIRST_NAME;
		}

	} // setFirstName()

	/**
	 * Set the value of [last_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setLastName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = UsersPeer::LAST_NAME;
		}

	} // setLastName()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setEmail($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = UsersPeer::EMAIL;
		}

	} // setEmail()

	/**
	 * Set the value of [sha1_password] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSha1Password($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sha1_password !== $v) {
			$this->sha1_password = $v;
			$this->modifiedColumns[] = UsersPeer::SHA1_PASSWORD;
		}

	} // setSha1Password()

	/**
	 * Set the value of [salt] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSalt($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = UsersPeer::SALT;
		}

	} // setSalt()

	/**
	 * Set the value of [want_to_be_moderator] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setWantToBeModerator($v)
	{

		if ($this->want_to_be_moderator !== $v || $v === false) {
			$this->want_to_be_moderator = $v;
			$this->modifiedColumns[] = UsersPeer::WANT_TO_BE_MODERATOR;
		}

	} // setWantToBeModerator()

	/**
	 * Set the value of [is_moderator] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsModerator($v)
	{

		if ($this->is_moderator !== $v || $v === false) {
			$this->is_moderator = $v;
			$this->modifiedColumns[] = UsersPeer::IS_MODERATOR;
		}

	} // setIsModerator()

	/**
	 * Set the value of [is_administrator] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsAdministrator($v)
	{

		if ($this->is_administrator !== $v || $v === false) {
			$this->is_administrator = $v;
			$this->modifiedColumns[] = UsersPeer::IS_ADMINISTRATOR;
		}

	} // setIsAdministrator()

	/**
	 * Set the value of [deletions] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setDeletions($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deletions !== $v || $v === 0) {
			$this->deletions = $v;
			$this->modifiedColumns[] = UsersPeer::DELETIONS;
		}

	} // setDeletions()

	/**
	 * Set the value of [password] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPassword($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = UsersPeer::PASSWORD;
		}

	} // setPassword()

	/**
	 * Set the value of [status] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setStatus($v)
	{

		if ($this->status !== $v || $v === true) {
			$this->status = $v;
			$this->modifiedColumns[] = UsersPeer::STATUS;
		}

	} // setStatus()

	/**
	 * Set the value of [culture] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCulture($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v || $v === 'en_US') {
			$this->culture = $v;
			$this->modifiedColumns[] = UsersPeer::CULTURE;
		}

	} // setCulture()

	/**
	 * Set the value of [confirmation_code] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setConfirmationCode($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->confirmation_code !== $v || $v === '') {
			$this->confirmation_code = $v;
			$this->modifiedColumns[] = UsersPeer::CONFIRMATION_CODE;
		}

	} // setConfirmationCode()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v || $v === '') {
			$this->name = $v;
			$this->modifiedColumns[] = UsersPeer::NAME;
		}

	} // setName()

	/**
	 * Set the value of [confirmed] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setConfirmed($v)
	{

		if ($this->confirmed !== $v || $v === false) {
			$this->confirmed = $v;
			$this->modifiedColumns[] = UsersPeer::CONFIRMED;
		}

	} // setConfirmed()

	/**
	 * Set the value of [remember_token] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setRememberToken($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->remember_token !== $v) {
			$this->remember_token = $v;
			$this->modifiedColumns[] = UsersPeer::REMEMBER_TOKEN;
		}

	} // setRememberToken()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->updated_at = $rs->getTimestamp($startcol + 2, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 3, null);

			$this->last_updated = $rs->getTimestamp($startcol + 4, null);

			$this->nickname = $rs->getString($startcol + 5);

			$this->salutation = $rs->getString($startcol + 6);

			$this->first_name = $rs->getString($startcol + 7);

			$this->last_name = $rs->getString($startcol + 8);

			$this->email = $rs->getString($startcol + 9);

			$this->sha1_password = $rs->getString($startcol + 10);

			$this->salt = $rs->getString($startcol + 11);

			$this->want_to_be_moderator = $rs->getBoolean($startcol + 12);

			$this->is_moderator = $rs->getBoolean($startcol + 13);

			$this->is_administrator = $rs->getBoolean($startcol + 14);

			$this->deletions = $rs->getInt($startcol + 15);

			$this->password = $rs->getString($startcol + 16);

			$this->status = $rs->getBoolean($startcol + 17);

			$this->culture = $rs->getString($startcol + 18);

			$this->confirmation_code = $rs->getString($startcol + 19);

			$this->name = $rs->getString($startcol + 20);

			$this->confirmed = $rs->getBoolean($startcol + 21);

			$this->remember_token = $rs->getString($startcol + 22);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 23; // 23 = UsersPeer::NUM_COLUMNS - UsersPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Users object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      Connection $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseUsers:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsersPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UsersPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseUsers:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseUsers:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(UsersPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(UsersPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsersPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseUsers:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave($con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UsersPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += UsersPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collAssignedRoless !== null) {
				foreach($this->collAssignedRoless as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collExportss !== null) {
				foreach($this->collExportss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHistorys !== null) {
				foreach($this->collHistorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collImportssRelatedByImportedBy !== null) {
				foreach($this->collImportssRelatedByImportedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collImportssRelatedByUserId !== null) {
				foreach($this->collImportssRelatedByUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilesRelatedByCreatedBy !== null) {
				foreach($this->collProfilesRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilesRelatedByUpdatedBy !== null) {
				foreach($this->collProfilesRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilesRelatedByDeletedBy !== null) {
				foreach($this->collProfilesRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilesRelatedByChildUpdatedBy !== null) {
				foreach($this->collProfilesRelatedByChildUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilePropertysRelatedByCreatedBy !== null) {
				foreach($this->collProfilePropertysRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilePropertysRelatedByUpdatedBy !== null) {
				foreach($this->collProfilePropertysRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilePropertysRelatedByDeletedBy !== null) {
				foreach($this->collProfilePropertysRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProjectUsers !== null) {
				foreach($this->collProjectUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProjectssRelatedByCreatedBy !== null) {
				foreach($this->collProjectssRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProjectssRelatedByUpdatedBy !== null) {
				foreach($this->collProjectssRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProjectssRelatedByDeletedBy !== null) {
				foreach($this->collProjectssRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAgentsRelatedByCreatedBy !== null) {
				foreach($this->collAgentsRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAgentsRelatedByUpdatedBy !== null) {
				foreach($this->collAgentsRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAgentsRelatedByDeletedBy !== null) {
				foreach($this->collAgentsRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAgentHasUsers !== null) {
				foreach($this->collAgentHasUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCollectionsRelatedByCreatedUserId !== null) {
				foreach($this->collCollectionsRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCollectionsRelatedByUpdatedUserId !== null) {
				foreach($this->collCollectionsRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCollectionsRelatedByCreatedBy !== null) {
				foreach($this->collCollectionsRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCollectionsRelatedByUpdatedBy !== null) {
				foreach($this->collCollectionsRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCollectionsRelatedByDeletedBy !== null) {
				foreach($this->collCollectionsRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptsRelatedByCreatedUserId !== null) {
				foreach($this->collConceptsRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptsRelatedByUpdatedUserId !== null) {
				foreach($this->collConceptsRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptsRelatedByCreatedBy !== null) {
				foreach($this->collConceptsRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptsRelatedByUpdatedBy !== null) {
				foreach($this->collConceptsRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptsRelatedByDeletedBy !== null) {
				foreach($this->collConceptsRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertysRelatedByCreatedUserId !== null) {
				foreach($this->collConceptPropertysRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertysRelatedByUpdatedUserId !== null) {
				foreach($this->collConceptPropertysRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertysRelatedByCreatedBy !== null) {
				foreach($this->collConceptPropertysRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertysRelatedByUpdatedBy !== null) {
				foreach($this->collConceptPropertysRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertysRelatedByDeletedBy !== null) {
				foreach($this->collConceptPropertysRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertyHistorysRelatedByCreatedUserId !== null) {
				foreach($this->collConceptPropertyHistorysRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertyHistorysRelatedByCreatedBy !== null) {
				foreach($this->collConceptPropertyHistorysRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDiscusssRelatedByCreatedUserId !== null) {
				foreach($this->collDiscusssRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDiscusssRelatedByDeletedUserId !== null) {
				foreach($this->collDiscusssRelatedByDeletedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDiscusssRelatedByCreatedBy !== null) {
				foreach($this->collDiscusssRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDiscusssRelatedByDeletedBy !== null) {
				foreach($this->collDiscusssRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collExportHistorysRelatedByUserId !== null) {
				foreach($this->collExportHistorysRelatedByUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collExportHistorysRelatedByExportedBy !== null) {
				foreach($this->collExportHistorysRelatedByExportedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFileImportHistorysRelatedByUserId !== null) {
				foreach($this->collFileImportHistorysRelatedByUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFileImportHistorysRelatedByImportedBy !== null) {
				foreach($this->collFileImportHistorysRelatedByImportedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemasRelatedByCreatedUserId !== null) {
				foreach($this->collSchemasRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemasRelatedByUpdatedUserId !== null) {
				foreach($this->collSchemasRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemasRelatedByDeletedUserId !== null) {
				foreach($this->collSchemasRelatedByDeletedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemasRelatedByCreatedBy !== null) {
				foreach($this->collSchemasRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemasRelatedByUpdatedBy !== null) {
				foreach($this->collSchemasRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemasRelatedByDeletedBy !== null) {
				foreach($this->collSchemasRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertysRelatedByCreatedUserId !== null) {
				foreach($this->collSchemaPropertysRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertysRelatedByUpdatedUserId !== null) {
				foreach($this->collSchemaPropertysRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertysRelatedByCreatedBy !== null) {
				foreach($this->collSchemaPropertysRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertysRelatedByUpdatedBy !== null) {
				foreach($this->collSchemaPropertysRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertysRelatedByDeletedBy !== null) {
				foreach($this->collSchemaPropertysRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementsRelatedByCreatedUserId !== null) {
				foreach($this->collSchemaPropertyElementsRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId !== null) {
				foreach($this->collSchemaPropertyElementsRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementsRelatedByDeletedUserId !== null) {
				foreach($this->collSchemaPropertyElementsRelatedByDeletedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementsRelatedByCreatedBy !== null) {
				foreach($this->collSchemaPropertyElementsRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementsRelatedByUpdatedBy !== null) {
				foreach($this->collSchemaPropertyElementsRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementsRelatedByDeletedBy !== null) {
				foreach($this->collSchemaPropertyElementsRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId !== null) {
				foreach($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementHistorysRelatedByCreatedBy !== null) {
				foreach($this->collSchemaPropertyElementHistorysRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByCreatedUserId !== null) {
				foreach($this->collVocabularysRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByUpdatedUserId !== null) {
				foreach($this->collVocabularysRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByDeletedUserId !== null) {
				foreach($this->collVocabularysRelatedByDeletedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByChildUpdatedUserId !== null) {
				foreach($this->collVocabularysRelatedByChildUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByCreatedBy !== null) {
				foreach($this->collVocabularysRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByUpdatedBy !== null) {
				foreach($this->collVocabularysRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByDeletedBy !== null) {
				foreach($this->collVocabularysRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByChildUpdatedBy !== null) {
				foreach($this->collVocabularysRelatedByChildUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularyHasUsers !== null) {
				foreach($this->collVocabularyHasUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularyHasVersionsRelatedByCreatedUserId !== null) {
				foreach($this->collVocabularyHasVersionsRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularyHasVersionsRelatedByCreatedBy !== null) {
				foreach($this->collVocabularyHasVersionsRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRoleUsers !== null) {
				foreach($this->collRoleUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaHasUsers !== null) {
				foreach($this->collSchemaHasUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaHasVersionsRelatedByCreatedUserId !== null) {
				foreach($this->collSchemaHasVersionsRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaHasVersionsRelatedByCreatedBy !== null) {
				foreach($this->collSchemaHasVersionsRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSocialLoginss !== null) {
				foreach($this->collSocialLoginss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = UsersPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAssignedRoless !== null) {
					foreach($this->collAssignedRoless as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collExportss !== null) {
					foreach($this->collExportss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHistorys !== null) {
					foreach($this->collHistorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collImportssRelatedByImportedBy !== null) {
					foreach($this->collImportssRelatedByImportedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collImportssRelatedByUserId !== null) {
					foreach($this->collImportssRelatedByUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilesRelatedByCreatedBy !== null) {
					foreach($this->collProfilesRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilesRelatedByUpdatedBy !== null) {
					foreach($this->collProfilesRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilesRelatedByDeletedBy !== null) {
					foreach($this->collProfilesRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilesRelatedByChildUpdatedBy !== null) {
					foreach($this->collProfilesRelatedByChildUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilePropertysRelatedByCreatedBy !== null) {
					foreach($this->collProfilePropertysRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilePropertysRelatedByUpdatedBy !== null) {
					foreach($this->collProfilePropertysRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilePropertysRelatedByDeletedBy !== null) {
					foreach($this->collProfilePropertysRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProjectUsers !== null) {
					foreach($this->collProjectUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProjectssRelatedByCreatedBy !== null) {
					foreach($this->collProjectssRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProjectssRelatedByUpdatedBy !== null) {
					foreach($this->collProjectssRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProjectssRelatedByDeletedBy !== null) {
					foreach($this->collProjectssRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAgentsRelatedByCreatedBy !== null) {
					foreach($this->collAgentsRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAgentsRelatedByUpdatedBy !== null) {
					foreach($this->collAgentsRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAgentsRelatedByDeletedBy !== null) {
					foreach($this->collAgentsRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAgentHasUsers !== null) {
					foreach($this->collAgentHasUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCollectionsRelatedByCreatedUserId !== null) {
					foreach($this->collCollectionsRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCollectionsRelatedByUpdatedUserId !== null) {
					foreach($this->collCollectionsRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCollectionsRelatedByCreatedBy !== null) {
					foreach($this->collCollectionsRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCollectionsRelatedByUpdatedBy !== null) {
					foreach($this->collCollectionsRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCollectionsRelatedByDeletedBy !== null) {
					foreach($this->collCollectionsRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptsRelatedByCreatedUserId !== null) {
					foreach($this->collConceptsRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptsRelatedByUpdatedUserId !== null) {
					foreach($this->collConceptsRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptsRelatedByCreatedBy !== null) {
					foreach($this->collConceptsRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptsRelatedByUpdatedBy !== null) {
					foreach($this->collConceptsRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptsRelatedByDeletedBy !== null) {
					foreach($this->collConceptsRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertysRelatedByCreatedUserId !== null) {
					foreach($this->collConceptPropertysRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertysRelatedByUpdatedUserId !== null) {
					foreach($this->collConceptPropertysRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertysRelatedByCreatedBy !== null) {
					foreach($this->collConceptPropertysRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertysRelatedByUpdatedBy !== null) {
					foreach($this->collConceptPropertysRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertysRelatedByDeletedBy !== null) {
					foreach($this->collConceptPropertysRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertyHistorysRelatedByCreatedUserId !== null) {
					foreach($this->collConceptPropertyHistorysRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertyHistorysRelatedByCreatedBy !== null) {
					foreach($this->collConceptPropertyHistorysRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDiscusssRelatedByCreatedUserId !== null) {
					foreach($this->collDiscusssRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDiscusssRelatedByDeletedUserId !== null) {
					foreach($this->collDiscusssRelatedByDeletedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDiscusssRelatedByCreatedBy !== null) {
					foreach($this->collDiscusssRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDiscusssRelatedByDeletedBy !== null) {
					foreach($this->collDiscusssRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collExportHistorysRelatedByUserId !== null) {
					foreach($this->collExportHistorysRelatedByUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collExportHistorysRelatedByExportedBy !== null) {
					foreach($this->collExportHistorysRelatedByExportedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFileImportHistorysRelatedByUserId !== null) {
					foreach($this->collFileImportHistorysRelatedByUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFileImportHistorysRelatedByImportedBy !== null) {
					foreach($this->collFileImportHistorysRelatedByImportedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemasRelatedByCreatedUserId !== null) {
					foreach($this->collSchemasRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemasRelatedByUpdatedUserId !== null) {
					foreach($this->collSchemasRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemasRelatedByDeletedUserId !== null) {
					foreach($this->collSchemasRelatedByDeletedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemasRelatedByCreatedBy !== null) {
					foreach($this->collSchemasRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemasRelatedByUpdatedBy !== null) {
					foreach($this->collSchemasRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemasRelatedByDeletedBy !== null) {
					foreach($this->collSchemasRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertysRelatedByCreatedUserId !== null) {
					foreach($this->collSchemaPropertysRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertysRelatedByUpdatedUserId !== null) {
					foreach($this->collSchemaPropertysRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertysRelatedByCreatedBy !== null) {
					foreach($this->collSchemaPropertysRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertysRelatedByUpdatedBy !== null) {
					foreach($this->collSchemaPropertysRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertysRelatedByDeletedBy !== null) {
					foreach($this->collSchemaPropertysRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementsRelatedByCreatedUserId !== null) {
					foreach($this->collSchemaPropertyElementsRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId !== null) {
					foreach($this->collSchemaPropertyElementsRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementsRelatedByDeletedUserId !== null) {
					foreach($this->collSchemaPropertyElementsRelatedByDeletedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementsRelatedByCreatedBy !== null) {
					foreach($this->collSchemaPropertyElementsRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementsRelatedByUpdatedBy !== null) {
					foreach($this->collSchemaPropertyElementsRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementsRelatedByDeletedBy !== null) {
					foreach($this->collSchemaPropertyElementsRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId !== null) {
					foreach($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementHistorysRelatedByCreatedBy !== null) {
					foreach($this->collSchemaPropertyElementHistorysRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByCreatedUserId !== null) {
					foreach($this->collVocabularysRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByUpdatedUserId !== null) {
					foreach($this->collVocabularysRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByDeletedUserId !== null) {
					foreach($this->collVocabularysRelatedByDeletedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByChildUpdatedUserId !== null) {
					foreach($this->collVocabularysRelatedByChildUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByCreatedBy !== null) {
					foreach($this->collVocabularysRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByUpdatedBy !== null) {
					foreach($this->collVocabularysRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByDeletedBy !== null) {
					foreach($this->collVocabularysRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByChildUpdatedBy !== null) {
					foreach($this->collVocabularysRelatedByChildUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularyHasUsers !== null) {
					foreach($this->collVocabularyHasUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularyHasVersionsRelatedByCreatedUserId !== null) {
					foreach($this->collVocabularyHasVersionsRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularyHasVersionsRelatedByCreatedBy !== null) {
					foreach($this->collVocabularyHasVersionsRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRoleUsers !== null) {
					foreach($this->collRoleUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaHasUsers !== null) {
					foreach($this->collSchemaHasUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaHasVersionsRelatedByCreatedUserId !== null) {
					foreach($this->collSchemaHasVersionsRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaHasVersionsRelatedByCreatedBy !== null) {
					foreach($this->collSchemaHasVersionsRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSocialLoginss !== null) {
					foreach($this->collSocialLoginss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsersPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getUpdatedAt();
				break;
			case 3:
				return $this->getDeletedAt();
				break;
			case 4:
				return $this->getLastUpdated();
				break;
			case 5:
				return $this->getNickname();
				break;
			case 6:
				return $this->getSalutation();
				break;
			case 7:
				return $this->getFirstName();
				break;
			case 8:
				return $this->getLastName();
				break;
			case 9:
				return $this->getEmail();
				break;
			case 10:
				return $this->getSha1Password();
				break;
			case 11:
				return $this->getSalt();
				break;
			case 12:
				return $this->getWantToBeModerator();
				break;
			case 13:
				return $this->getIsModerator();
				break;
			case 14:
				return $this->getIsAdministrator();
				break;
			case 15:
				return $this->getDeletions();
				break;
			case 16:
				return $this->getPassword();
				break;
			case 17:
				return $this->getStatus();
				break;
			case 18:
				return $this->getCulture();
				break;
			case 19:
				return $this->getConfirmationCode();
				break;
			case 20:
				return $this->getName();
				break;
			case 21:
				return $this->getConfirmed();
				break;
			case 22:
				return $this->getRememberToken();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsersPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getDeletedAt(),
			$keys[4] => $this->getLastUpdated(),
			$keys[5] => $this->getNickname(),
			$keys[6] => $this->getSalutation(),
			$keys[7] => $this->getFirstName(),
			$keys[8] => $this->getLastName(),
			$keys[9] => $this->getEmail(),
			$keys[10] => $this->getSha1Password(),
			$keys[11] => $this->getSalt(),
			$keys[12] => $this->getWantToBeModerator(),
			$keys[13] => $this->getIsModerator(),
			$keys[14] => $this->getIsAdministrator(),
			$keys[15] => $this->getDeletions(),
			$keys[16] => $this->getPassword(),
			$keys[17] => $this->getStatus(),
			$keys[18] => $this->getCulture(),
			$keys[19] => $this->getConfirmationCode(),
			$keys[20] => $this->getName(),
			$keys[21] => $this->getConfirmed(),
			$keys[22] => $this->getRememberToken(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsersPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setUpdatedAt($value);
				break;
			case 3:
				$this->setDeletedAt($value);
				break;
			case 4:
				$this->setLastUpdated($value);
				break;
			case 5:
				$this->setNickname($value);
				break;
			case 6:
				$this->setSalutation($value);
				break;
			case 7:
				$this->setFirstName($value);
				break;
			case 8:
				$this->setLastName($value);
				break;
			case 9:
				$this->setEmail($value);
				break;
			case 10:
				$this->setSha1Password($value);
				break;
			case 11:
				$this->setSalt($value);
				break;
			case 12:
				$this->setWantToBeModerator($value);
				break;
			case 13:
				$this->setIsModerator($value);
				break;
			case 14:
				$this->setIsAdministrator($value);
				break;
			case 15:
				$this->setDeletions($value);
				break;
			case 16:
				$this->setPassword($value);
				break;
			case 17:
				$this->setStatus($value);
				break;
			case 18:
				$this->setCulture($value);
				break;
			case 19:
				$this->setConfirmationCode($value);
				break;
			case 20:
				$this->setName($value);
				break;
			case 21:
				$this->setConfirmed($value);
				break;
			case 22:
				$this->setRememberToken($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsersPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeletedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLastUpdated($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNickname($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSalutation($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setFirstName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLastName($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEmail($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSha1Password($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setSalt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setWantToBeModerator($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIsModerator($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setIsAdministrator($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setDeletions($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setPassword($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setStatus($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCulture($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setConfirmationCode($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setName($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setConfirmed($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setRememberToken($arr[$keys[22]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(UsersPeer::DATABASE_NAME);

		if ($this->isColumnModified(UsersPeer::ID)) $criteria->add(UsersPeer::ID, $this->id);
		if ($this->isColumnModified(UsersPeer::CREATED_AT)) $criteria->add(UsersPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(UsersPeer::UPDATED_AT)) $criteria->add(UsersPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(UsersPeer::DELETED_AT)) $criteria->add(UsersPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(UsersPeer::LAST_UPDATED)) $criteria->add(UsersPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(UsersPeer::NICKNAME)) $criteria->add(UsersPeer::NICKNAME, $this->nickname);
		if ($this->isColumnModified(UsersPeer::SALUTATION)) $criteria->add(UsersPeer::SALUTATION, $this->salutation);
		if ($this->isColumnModified(UsersPeer::FIRST_NAME)) $criteria->add(UsersPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(UsersPeer::LAST_NAME)) $criteria->add(UsersPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(UsersPeer::EMAIL)) $criteria->add(UsersPeer::EMAIL, $this->email);
		if ($this->isColumnModified(UsersPeer::SHA1_PASSWORD)) $criteria->add(UsersPeer::SHA1_PASSWORD, $this->sha1_password);
		if ($this->isColumnModified(UsersPeer::SALT)) $criteria->add(UsersPeer::SALT, $this->salt);
		if ($this->isColumnModified(UsersPeer::WANT_TO_BE_MODERATOR)) $criteria->add(UsersPeer::WANT_TO_BE_MODERATOR, $this->want_to_be_moderator);
		if ($this->isColumnModified(UsersPeer::IS_MODERATOR)) $criteria->add(UsersPeer::IS_MODERATOR, $this->is_moderator);
		if ($this->isColumnModified(UsersPeer::IS_ADMINISTRATOR)) $criteria->add(UsersPeer::IS_ADMINISTRATOR, $this->is_administrator);
		if ($this->isColumnModified(UsersPeer::DELETIONS)) $criteria->add(UsersPeer::DELETIONS, $this->deletions);
		if ($this->isColumnModified(UsersPeer::PASSWORD)) $criteria->add(UsersPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(UsersPeer::STATUS)) $criteria->add(UsersPeer::STATUS, $this->status);
		if ($this->isColumnModified(UsersPeer::CULTURE)) $criteria->add(UsersPeer::CULTURE, $this->culture);
		if ($this->isColumnModified(UsersPeer::CONFIRMATION_CODE)) $criteria->add(UsersPeer::CONFIRMATION_CODE, $this->confirmation_code);
		if ($this->isColumnModified(UsersPeer::NAME)) $criteria->add(UsersPeer::NAME, $this->name);
		if ($this->isColumnModified(UsersPeer::CONFIRMED)) $criteria->add(UsersPeer::CONFIRMED, $this->confirmed);
		if ($this->isColumnModified(UsersPeer::REMEMBER_TOKEN)) $criteria->add(UsersPeer::REMEMBER_TOKEN, $this->remember_token);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UsersPeer::DATABASE_NAME);

		$criteria->add(UsersPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Users (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setLastUpdated($this->last_updated);

		$copyObj->setNickname($this->nickname);

		$copyObj->setSalutation($this->salutation);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setEmail($this->email);

		$copyObj->setSha1Password($this->sha1_password);

		$copyObj->setSalt($this->salt);

		$copyObj->setWantToBeModerator($this->want_to_be_moderator);

		$copyObj->setIsModerator($this->is_moderator);

		$copyObj->setIsAdministrator($this->is_administrator);

		$copyObj->setDeletions($this->deletions);

		$copyObj->setPassword($this->password);

		$copyObj->setStatus($this->status);

		$copyObj->setCulture($this->culture);

		$copyObj->setConfirmationCode($this->confirmation_code);

		$copyObj->setName($this->name);

		$copyObj->setConfirmed($this->confirmed);

		$copyObj->setRememberToken($this->remember_token);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getAssignedRoless() as $relObj) {
				$copyObj->addAssignedRoles($relObj->copy($deepCopy));
			}

			foreach($this->getExportss() as $relObj) {
				$copyObj->addExports($relObj->copy($deepCopy));
			}

			foreach($this->getHistorys() as $relObj) {
				$copyObj->addHistory($relObj->copy($deepCopy));
			}

			foreach($this->getImportssRelatedByImportedBy() as $relObj) {
				$copyObj->addImportsRelatedByImportedBy($relObj->copy($deepCopy));
			}

			foreach($this->getImportssRelatedByUserId() as $relObj) {
				$copyObj->addImportsRelatedByUserId($relObj->copy($deepCopy));
			}

			foreach($this->getProfilesRelatedByCreatedBy() as $relObj) {
				$copyObj->addProfileRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProfilesRelatedByUpdatedBy() as $relObj) {
				$copyObj->addProfileRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProfilesRelatedByDeletedBy() as $relObj) {
				$copyObj->addProfileRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProfilesRelatedByChildUpdatedBy() as $relObj) {
				$copyObj->addProfileRelatedByChildUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProfilePropertysRelatedByCreatedBy() as $relObj) {
				$copyObj->addProfilePropertyRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProfilePropertysRelatedByUpdatedBy() as $relObj) {
				$copyObj->addProfilePropertyRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProfilePropertysRelatedByDeletedBy() as $relObj) {
				$copyObj->addProfilePropertyRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProjectUsers() as $relObj) {
				$copyObj->addProjectUser($relObj->copy($deepCopy));
			}

			foreach($this->getProjectssRelatedByCreatedBy() as $relObj) {
				$copyObj->addProjectsRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProjectssRelatedByUpdatedBy() as $relObj) {
				$copyObj->addProjectsRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProjectssRelatedByDeletedBy() as $relObj) {
				$copyObj->addProjectsRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getAgentsRelatedByCreatedBy() as $relObj) {
				$copyObj->addAgentRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getAgentsRelatedByUpdatedBy() as $relObj) {
				$copyObj->addAgentRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getAgentsRelatedByDeletedBy() as $relObj) {
				$copyObj->addAgentRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getAgentHasUsers() as $relObj) {
				$copyObj->addAgentHasUser($relObj->copy($deepCopy));
			}

			foreach($this->getCollectionsRelatedByCreatedUserId() as $relObj) {
				$copyObj->addCollectionRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getCollectionsRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addCollectionRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getCollectionsRelatedByCreatedBy() as $relObj) {
				$copyObj->addCollectionRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getCollectionsRelatedByUpdatedBy() as $relObj) {
				$copyObj->addCollectionRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getCollectionsRelatedByDeletedBy() as $relObj) {
				$copyObj->addCollectionRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getConceptsRelatedByCreatedUserId() as $relObj) {
				$copyObj->addConceptRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptsRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addConceptRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptsRelatedByCreatedBy() as $relObj) {
				$copyObj->addConceptRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getConceptsRelatedByUpdatedBy() as $relObj) {
				$copyObj->addConceptRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getConceptsRelatedByDeletedBy() as $relObj) {
				$copyObj->addConceptRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertysRelatedByCreatedUserId() as $relObj) {
				$copyObj->addConceptPropertyRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertysRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addConceptPropertyRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertysRelatedByCreatedBy() as $relObj) {
				$copyObj->addConceptPropertyRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertysRelatedByUpdatedBy() as $relObj) {
				$copyObj->addConceptPropertyRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertysRelatedByDeletedBy() as $relObj) {
				$copyObj->addConceptPropertyRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorysRelatedByCreatedUserId() as $relObj) {
				$copyObj->addConceptPropertyHistoryRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorysRelatedByCreatedBy() as $relObj) {
				$copyObj->addConceptPropertyHistoryRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getDiscusssRelatedByCreatedUserId() as $relObj) {
				$copyObj->addDiscussRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getDiscusssRelatedByDeletedUserId() as $relObj) {
				$copyObj->addDiscussRelatedByDeletedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getDiscusssRelatedByCreatedBy() as $relObj) {
				$copyObj->addDiscussRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getDiscusssRelatedByDeletedBy() as $relObj) {
				$copyObj->addDiscussRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getExportHistorysRelatedByUserId() as $relObj) {
				$copyObj->addExportHistoryRelatedByUserId($relObj->copy($deepCopy));
			}

			foreach($this->getExportHistorysRelatedByExportedBy() as $relObj) {
				$copyObj->addExportHistoryRelatedByExportedBy($relObj->copy($deepCopy));
			}

			foreach($this->getFileImportHistorysRelatedByUserId() as $relObj) {
				$copyObj->addFileImportHistoryRelatedByUserId($relObj->copy($deepCopy));
			}

			foreach($this->getFileImportHistorysRelatedByImportedBy() as $relObj) {
				$copyObj->addFileImportHistoryRelatedByImportedBy($relObj->copy($deepCopy));
			}

			foreach($this->getSchemasRelatedByCreatedUserId() as $relObj) {
				$copyObj->addSchemaRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemasRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addSchemaRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemasRelatedByDeletedUserId() as $relObj) {
				$copyObj->addSchemaRelatedByDeletedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemasRelatedByCreatedBy() as $relObj) {
				$copyObj->addSchemaRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getSchemasRelatedByUpdatedBy() as $relObj) {
				$copyObj->addSchemaRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getSchemasRelatedByDeletedBy() as $relObj) {
				$copyObj->addSchemaRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertysRelatedByCreatedUserId() as $relObj) {
				$copyObj->addSchemaPropertyRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertysRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addSchemaPropertyRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertysRelatedByCreatedBy() as $relObj) {
				$copyObj->addSchemaPropertyRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertysRelatedByUpdatedBy() as $relObj) {
				$copyObj->addSchemaPropertyRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertysRelatedByDeletedBy() as $relObj) {
				$copyObj->addSchemaPropertyRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementsRelatedByCreatedUserId() as $relObj) {
				$copyObj->addSchemaPropertyElementRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementsRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addSchemaPropertyElementRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementsRelatedByDeletedUserId() as $relObj) {
				$copyObj->addSchemaPropertyElementRelatedByDeletedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementsRelatedByCreatedBy() as $relObj) {
				$copyObj->addSchemaPropertyElementRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementsRelatedByUpdatedBy() as $relObj) {
				$copyObj->addSchemaPropertyElementRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementsRelatedByDeletedBy() as $relObj) {
				$copyObj->addSchemaPropertyElementRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementHistorysRelatedByCreatedUserId() as $relObj) {
				$copyObj->addSchemaPropertyElementHistoryRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementHistorysRelatedByCreatedBy() as $relObj) {
				$copyObj->addSchemaPropertyElementHistoryRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByCreatedUserId() as $relObj) {
				$copyObj->addVocabularyRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addVocabularyRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByDeletedUserId() as $relObj) {
				$copyObj->addVocabularyRelatedByDeletedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByChildUpdatedUserId() as $relObj) {
				$copyObj->addVocabularyRelatedByChildUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByCreatedBy() as $relObj) {
				$copyObj->addVocabularyRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByUpdatedBy() as $relObj) {
				$copyObj->addVocabularyRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByDeletedBy() as $relObj) {
				$copyObj->addVocabularyRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByChildUpdatedBy() as $relObj) {
				$copyObj->addVocabularyRelatedByChildUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularyHasUsers() as $relObj) {
				$copyObj->addVocabularyHasUser($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularyHasVersionsRelatedByCreatedUserId() as $relObj) {
				$copyObj->addVocabularyHasVersionRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularyHasVersionsRelatedByCreatedBy() as $relObj) {
				$copyObj->addVocabularyHasVersionRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getRoleUsers() as $relObj) {
				$copyObj->addRoleUser($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaHasUsers() as $relObj) {
				$copyObj->addSchemaHasUser($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaHasVersionsRelatedByCreatedUserId() as $relObj) {
				$copyObj->addSchemaHasVersionRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaHasVersionsRelatedByCreatedBy() as $relObj) {
				$copyObj->addSchemaHasVersionRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getSocialLoginss() as $relObj) {
				$copyObj->addSocialLogins($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a pkey column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Users Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     UsersPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UsersPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collAssignedRoless to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initAssignedRoless()
	{
		if ($this->collAssignedRoless === null) {
			$this->collAssignedRoless = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related AssignedRoless from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getAssignedRoless($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAssignedRolesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAssignedRoless === null) {
			if ($this->isNew()) {
			   $this->collAssignedRoless = array();
			} else {

				$criteria->add(AssignedRolesPeer::USER_ID, $this->getId());

				AssignedRolesPeer::addSelectColumns($criteria);
				$this->collAssignedRoless = AssignedRolesPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AssignedRolesPeer::USER_ID, $this->getId());

				AssignedRolesPeer::addSelectColumns($criteria);
				if (!isset($this->lastAssignedRolesCriteria) || !$this->lastAssignedRolesCriteria->equals($criteria)) {
					$this->collAssignedRoless = AssignedRolesPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAssignedRolesCriteria = $criteria;
		return $this->collAssignedRoless;
	}

	/**
	 * Returns the number of related AssignedRoless.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countAssignedRoless($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAssignedRolesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AssignedRolesPeer::USER_ID, $this->getId());

		return AssignedRolesPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a AssignedRoles object to this object
	 * through the AssignedRoles foreign key attribute
	 *
	 * @param      AssignedRoles $l AssignedRoles
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAssignedRoles(AssignedRoles $l)
	{
		$this->collAssignedRoless[] = $l;
		$l->setUsers($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related AssignedRoless from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getAssignedRolessJoinRoles($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAssignedRolesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAssignedRoless === null) {
			if ($this->isNew()) {
				$this->collAssignedRoless = array();
			} else {

				$criteria->add(AssignedRolesPeer::USER_ID, $this->getId());

				$this->collAssignedRoless = AssignedRolesPeer::doSelectJoinRoles($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AssignedRolesPeer::USER_ID, $this->getId());

			if (!isset($this->lastAssignedRolesCriteria) || !$this->lastAssignedRolesCriteria->equals($criteria)) {
				$this->collAssignedRoless = AssignedRolesPeer::doSelectJoinRoles($criteria, $con);
			}
		}
		$this->lastAssignedRolesCriteria = $criteria;

		return $this->collAssignedRoless;
	}

	/**
	 * Temporary storage of collExportss to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initExportss()
	{
		if ($this->collExportss === null) {
			$this->collExportss = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related Exportss from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getExportss($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportss === null) {
			if ($this->isNew()) {
			   $this->collExportss = array();
			} else {

				$criteria->add(ExportsPeer::USER_ID, $this->getId());

				ExportsPeer::addSelectColumns($criteria);
				$this->collExportss = ExportsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ExportsPeer::USER_ID, $this->getId());

				ExportsPeer::addSelectColumns($criteria);
				if (!isset($this->lastExportsCriteria) || !$this->lastExportsCriteria->equals($criteria)) {
					$this->collExportss = ExportsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastExportsCriteria = $criteria;
		return $this->collExportss;
	}

	/**
	 * Returns the number of related Exportss.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countExportss($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ExportsPeer::USER_ID, $this->getId());

		return ExportsPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Exports object to this object
	 * through the Exports foreign key attribute
	 *
	 * @param      Exports $l Exports
	 * @return     void
	 * @throws     PropelException
	 */
	public function addExports(Exports $l)
	{
		$this->collExportss[] = $l;
		$l->setUsers($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related Exportss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getExportssJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportss === null) {
			if ($this->isNew()) {
				$this->collExportss = array();
			} else {

				$criteria->add(ExportsPeer::USER_ID, $this->getId());

				$this->collExportss = ExportsPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportsPeer::USER_ID, $this->getId());

			if (!isset($this->lastExportsCriteria) || !$this->lastExportsCriteria->equals($criteria)) {
				$this->collExportss = ExportsPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastExportsCriteria = $criteria;

		return $this->collExportss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related Exportss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getExportssJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportss === null) {
			if ($this->isNew()) {
				$this->collExportss = array();
			} else {

				$criteria->add(ExportsPeer::USER_ID, $this->getId());

				$this->collExportss = ExportsPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportsPeer::USER_ID, $this->getId());

			if (!isset($this->lastExportsCriteria) || !$this->lastExportsCriteria->equals($criteria)) {
				$this->collExportss = ExportsPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastExportsCriteria = $criteria;

		return $this->collExportss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related Exportss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getExportssJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportss === null) {
			if ($this->isNew()) {
				$this->collExportss = array();
			} else {

				$criteria->add(ExportsPeer::USER_ID, $this->getId());

				$this->collExportss = ExportsPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportsPeer::USER_ID, $this->getId());

			if (!isset($this->lastExportsCriteria) || !$this->lastExportsCriteria->equals($criteria)) {
				$this->collExportss = ExportsPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastExportsCriteria = $criteria;

		return $this->collExportss;
	}

	/**
	 * Temporary storage of collHistorys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initHistorys()
	{
		if ($this->collHistorys === null) {
			$this->collHistorys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related Historys from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getHistorys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHistorys === null) {
			if ($this->isNew()) {
			   $this->collHistorys = array();
			} else {

				$criteria->add(HistoryPeer::USER_ID, $this->getId());

				HistoryPeer::addSelectColumns($criteria);
				$this->collHistorys = HistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(HistoryPeer::USER_ID, $this->getId());

				HistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastHistoryCriteria) || !$this->lastHistoryCriteria->equals($criteria)) {
					$this->collHistorys = HistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHistoryCriteria = $criteria;
		return $this->collHistorys;
	}

	/**
	 * Returns the number of related Historys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countHistorys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(HistoryPeer::USER_ID, $this->getId());

		return HistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a History object to this object
	 * through the History foreign key attribute
	 *
	 * @param      History $l History
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHistory(History $l)
	{
		$this->collHistorys[] = $l;
		$l->setUsers($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related Historys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getHistorysJoinHistoryTypes($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHistorys === null) {
			if ($this->isNew()) {
				$this->collHistorys = array();
			} else {

				$criteria->add(HistoryPeer::USER_ID, $this->getId());

				$this->collHistorys = HistoryPeer::doSelectJoinHistoryTypes($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HistoryPeer::USER_ID, $this->getId());

			if (!isset($this->lastHistoryCriteria) || !$this->lastHistoryCriteria->equals($criteria)) {
				$this->collHistorys = HistoryPeer::doSelectJoinHistoryTypes($criteria, $con);
			}
		}
		$this->lastHistoryCriteria = $criteria;

		return $this->collHistorys;
	}

	/**
	 * Temporary storage of collImportssRelatedByImportedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initImportssRelatedByImportedBy()
	{
		if ($this->collImportssRelatedByImportedBy === null) {
			$this->collImportssRelatedByImportedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ImportssRelatedByImportedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getImportssRelatedByImportedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collImportssRelatedByImportedBy === null) {
			if ($this->isNew()) {
			   $this->collImportssRelatedByImportedBy = array();
			} else {

				$criteria->add(ImportsPeer::IMPORTED_BY, $this->getId());

				ImportsPeer::addSelectColumns($criteria);
				$this->collImportssRelatedByImportedBy = ImportsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ImportsPeer::IMPORTED_BY, $this->getId());

				ImportsPeer::addSelectColumns($criteria);
				if (!isset($this->lastImportsRelatedByImportedByCriteria) || !$this->lastImportsRelatedByImportedByCriteria->equals($criteria)) {
					$this->collImportssRelatedByImportedBy = ImportsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastImportsRelatedByImportedByCriteria = $criteria;
		return $this->collImportssRelatedByImportedBy;
	}

	/**
	 * Returns the number of related ImportssRelatedByImportedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countImportssRelatedByImportedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ImportsPeer::IMPORTED_BY, $this->getId());

		return ImportsPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Imports object to this object
	 * through the Imports foreign key attribute
	 *
	 * @param      Imports $l Imports
	 * @return     void
	 * @throws     PropelException
	 */
	public function addImportsRelatedByImportedBy(Imports $l)
	{
		$this->collImportssRelatedByImportedBy[] = $l;
		$l->setUsersRelatedByImportedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ImportssRelatedByImportedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getImportssRelatedByImportedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collImportssRelatedByImportedBy === null) {
			if ($this->isNew()) {
				$this->collImportssRelatedByImportedBy = array();
			} else {

				$criteria->add(ImportsPeer::IMPORTED_BY, $this->getId());

				$this->collImportssRelatedByImportedBy = ImportsPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ImportsPeer::IMPORTED_BY, $this->getId());

			if (!isset($this->lastImportsRelatedByImportedByCriteria) || !$this->lastImportsRelatedByImportedByCriteria->equals($criteria)) {
				$this->collImportssRelatedByImportedBy = ImportsPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastImportsRelatedByImportedByCriteria = $criteria;

		return $this->collImportssRelatedByImportedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ImportssRelatedByImportedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getImportssRelatedByImportedByJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collImportssRelatedByImportedBy === null) {
			if ($this->isNew()) {
				$this->collImportssRelatedByImportedBy = array();
			} else {

				$criteria->add(ImportsPeer::IMPORTED_BY, $this->getId());

				$this->collImportssRelatedByImportedBy = ImportsPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ImportsPeer::IMPORTED_BY, $this->getId());

			if (!isset($this->lastImportsRelatedByImportedByCriteria) || !$this->lastImportsRelatedByImportedByCriteria->equals($criteria)) {
				$this->collImportssRelatedByImportedBy = ImportsPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastImportsRelatedByImportedByCriteria = $criteria;

		return $this->collImportssRelatedByImportedBy;
	}

	/**
	 * Temporary storage of collImportssRelatedByUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initImportssRelatedByUserId()
	{
		if ($this->collImportssRelatedByUserId === null) {
			$this->collImportssRelatedByUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ImportssRelatedByUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getImportssRelatedByUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collImportssRelatedByUserId === null) {
			if ($this->isNew()) {
			   $this->collImportssRelatedByUserId = array();
			} else {

				$criteria->add(ImportsPeer::USER_ID, $this->getId());

				ImportsPeer::addSelectColumns($criteria);
				$this->collImportssRelatedByUserId = ImportsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ImportsPeer::USER_ID, $this->getId());

				ImportsPeer::addSelectColumns($criteria);
				if (!isset($this->lastImportsRelatedByUserIdCriteria) || !$this->lastImportsRelatedByUserIdCriteria->equals($criteria)) {
					$this->collImportssRelatedByUserId = ImportsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastImportsRelatedByUserIdCriteria = $criteria;
		return $this->collImportssRelatedByUserId;
	}

	/**
	 * Returns the number of related ImportssRelatedByUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countImportssRelatedByUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ImportsPeer::USER_ID, $this->getId());

		return ImportsPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Imports object to this object
	 * through the Imports foreign key attribute
	 *
	 * @param      Imports $l Imports
	 * @return     void
	 * @throws     PropelException
	 */
	public function addImportsRelatedByUserId(Imports $l)
	{
		$this->collImportssRelatedByUserId[] = $l;
		$l->setUsersRelatedByUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ImportssRelatedByUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getImportssRelatedByUserIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collImportssRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collImportssRelatedByUserId = array();
			} else {

				$criteria->add(ImportsPeer::USER_ID, $this->getId());

				$this->collImportssRelatedByUserId = ImportsPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ImportsPeer::USER_ID, $this->getId());

			if (!isset($this->lastImportsRelatedByUserIdCriteria) || !$this->lastImportsRelatedByUserIdCriteria->equals($criteria)) {
				$this->collImportssRelatedByUserId = ImportsPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastImportsRelatedByUserIdCriteria = $criteria;

		return $this->collImportssRelatedByUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ImportssRelatedByUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getImportssRelatedByUserIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collImportssRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collImportssRelatedByUserId = array();
			} else {

				$criteria->add(ImportsPeer::USER_ID, $this->getId());

				$this->collImportssRelatedByUserId = ImportsPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ImportsPeer::USER_ID, $this->getId());

			if (!isset($this->lastImportsRelatedByUserIdCriteria) || !$this->lastImportsRelatedByUserIdCriteria->equals($criteria)) {
				$this->collImportssRelatedByUserId = ImportsPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastImportsRelatedByUserIdCriteria = $criteria;

		return $this->collImportssRelatedByUserId;
	}

	/**
	 * Temporary storage of collProfilesRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilesRelatedByCreatedBy()
	{
		if ($this->collProfilesRelatedByCreatedBy === null) {
			$this->collProfilesRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ProfilesRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilesRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilesRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePeer::CREATED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				$this->collProfilesRelatedByCreatedBy = ProfilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePeer::CREATED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastProfileRelatedByCreatedByCriteria) || !$this->lastProfileRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collProfilesRelatedByCreatedBy = ProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfileRelatedByCreatedByCriteria = $criteria;
		return $this->collProfilesRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related ProfilesRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilesRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfilePeer::CREATED_BY, $this->getId());

		return ProfilePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Profile object to this object
	 * through the Profile foreign key attribute
	 *
	 * @param      Profile $l Profile
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfileRelatedByCreatedBy(Profile $l)
	{
		$this->collProfilesRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilesRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilesRelatedByCreatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilesRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePeer::CREATED_BY, $this->getId());

				$this->collProfilesRelatedByCreatedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePeer::CREATED_BY, $this->getId());

			if (!isset($this->lastProfileRelatedByCreatedByCriteria) || !$this->lastProfileRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collProfilesRelatedByCreatedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfileRelatedByCreatedByCriteria = $criteria;

		return $this->collProfilesRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collProfilesRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilesRelatedByUpdatedBy()
	{
		if ($this->collProfilesRelatedByUpdatedBy === null) {
			$this->collProfilesRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ProfilesRelatedByUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilesRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilesRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePeer::UPDATED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				$this->collProfilesRelatedByUpdatedBy = ProfilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePeer::UPDATED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastProfileRelatedByUpdatedByCriteria) || !$this->lastProfileRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collProfilesRelatedByUpdatedBy = ProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfileRelatedByUpdatedByCriteria = $criteria;
		return $this->collProfilesRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related ProfilesRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilesRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfilePeer::UPDATED_BY, $this->getId());

		return ProfilePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Profile object to this object
	 * through the Profile foreign key attribute
	 *
	 * @param      Profile $l Profile
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfileRelatedByUpdatedBy(Profile $l)
	{
		$this->collProfilesRelatedByUpdatedBy[] = $l;
		$l->setUsersRelatedByUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilesRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilesRelatedByUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilesRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePeer::UPDATED_BY, $this->getId());

				$this->collProfilesRelatedByUpdatedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastProfileRelatedByUpdatedByCriteria) || !$this->lastProfileRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collProfilesRelatedByUpdatedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfileRelatedByUpdatedByCriteria = $criteria;

		return $this->collProfilesRelatedByUpdatedBy;
	}

	/**
	 * Temporary storage of collProfilesRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilesRelatedByDeletedBy()
	{
		if ($this->collProfilesRelatedByDeletedBy === null) {
			$this->collProfilesRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ProfilesRelatedByDeletedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilesRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilesRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePeer::DELETED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				$this->collProfilesRelatedByDeletedBy = ProfilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePeer::DELETED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastProfileRelatedByDeletedByCriteria) || !$this->lastProfileRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collProfilesRelatedByDeletedBy = ProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfileRelatedByDeletedByCriteria = $criteria;
		return $this->collProfilesRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related ProfilesRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilesRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfilePeer::DELETED_BY, $this->getId());

		return ProfilePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Profile object to this object
	 * through the Profile foreign key attribute
	 *
	 * @param      Profile $l Profile
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfileRelatedByDeletedBy(Profile $l)
	{
		$this->collProfilesRelatedByDeletedBy[] = $l;
		$l->setUsersRelatedByDeletedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilesRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilesRelatedByDeletedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collProfilesRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePeer::DELETED_BY, $this->getId());

				$this->collProfilesRelatedByDeletedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePeer::DELETED_BY, $this->getId());

			if (!isset($this->lastProfileRelatedByDeletedByCriteria) || !$this->lastProfileRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collProfilesRelatedByDeletedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfileRelatedByDeletedByCriteria = $criteria;

		return $this->collProfilesRelatedByDeletedBy;
	}

	/**
	 * Temporary storage of collProfilesRelatedByChildUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilesRelatedByChildUpdatedBy()
	{
		if ($this->collProfilesRelatedByChildUpdatedBy === null) {
			$this->collProfilesRelatedByChildUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ProfilesRelatedByChildUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilesRelatedByChildUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByChildUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilesRelatedByChildUpdatedBy = array();
			} else {

				$criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				$this->collProfilesRelatedByChildUpdatedBy = ProfilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastProfileRelatedByChildUpdatedByCriteria) || !$this->lastProfileRelatedByChildUpdatedByCriteria->equals($criteria)) {
					$this->collProfilesRelatedByChildUpdatedBy = ProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfileRelatedByChildUpdatedByCriteria = $criteria;
		return $this->collProfilesRelatedByChildUpdatedBy;
	}

	/**
	 * Returns the number of related ProfilesRelatedByChildUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilesRelatedByChildUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->getId());

		return ProfilePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Profile object to this object
	 * through the Profile foreign key attribute
	 *
	 * @param      Profile $l Profile
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfileRelatedByChildUpdatedBy(Profile $l)
	{
		$this->collProfilesRelatedByChildUpdatedBy[] = $l;
		$l->setUsersRelatedByChildUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilesRelatedByChildUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilesRelatedByChildUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByChildUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilesRelatedByChildUpdatedBy = array();
			} else {

				$criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->getId());

				$this->collProfilesRelatedByChildUpdatedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->getId());

			if (!isset($this->lastProfileRelatedByChildUpdatedByCriteria) || !$this->lastProfileRelatedByChildUpdatedByCriteria->equals($criteria)) {
				$this->collProfilesRelatedByChildUpdatedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfileRelatedByChildUpdatedByCriteria = $criteria;

		return $this->collProfilesRelatedByChildUpdatedBy;
	}

	/**
	 * Temporary storage of collProfilePropertysRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilePropertysRelatedByCreatedBy()
	{
		if ($this->collProfilePropertysRelatedByCreatedBy === null) {
			$this->collProfilePropertysRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilePropertysRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilePropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastProfilePropertyRelatedByCreatedByCriteria) || !$this->lastProfilePropertyRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfilePropertyRelatedByCreatedByCriteria = $criteria;
		return $this->collProfilePropertysRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related ProfilePropertysRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilePropertysRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

		return ProfilePropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ProfileProperty object to this object
	 * through the ProfileProperty foreign key attribute
	 *
	 * @param      ProfileProperty $l ProfileProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfilePropertyRelatedByCreatedBy(ProfileProperty $l)
	{
		$this->collProfilePropertysRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilePropertysRelatedByCreatedByJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByCreatedByCriteria) || !$this->lastProfilePropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilePropertysRelatedByCreatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByCreatedByCriteria) || !$this->lastProfilePropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilePropertysRelatedByCreatedByJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByCreatedByCriteria) || !$this->lastProfilePropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collProfilePropertysRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilePropertysRelatedByUpdatedBy()
	{
		if ($this->collProfilePropertysRelatedByUpdatedBy === null) {
			$this->collProfilePropertysRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilePropertysRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilePropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastProfilePropertyRelatedByUpdatedByCriteria) || !$this->lastProfilePropertyRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfilePropertyRelatedByUpdatedByCriteria = $criteria;
		return $this->collProfilePropertysRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related ProfilePropertysRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilePropertysRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

		return ProfilePropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ProfileProperty object to this object
	 * through the ProfileProperty foreign key attribute
	 *
	 * @param      ProfileProperty $l ProfileProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfilePropertyRelatedByUpdatedBy(ProfileProperty $l)
	{
		$this->collProfilePropertysRelatedByUpdatedBy[] = $l;
		$l->setUsersRelatedByUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilePropertysRelatedByUpdatedByJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByUpdatedByCriteria) || !$this->lastProfilePropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilePropertysRelatedByUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByUpdatedByCriteria) || !$this->lastProfilePropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilePropertysRelatedByUpdatedByJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByUpdatedByCriteria) || !$this->lastProfilePropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByUpdatedBy;
	}

	/**
	 * Temporary storage of collProfilePropertysRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilePropertysRelatedByDeletedBy()
	{
		if ($this->collProfilePropertysRelatedByDeletedBy === null) {
			$this->collProfilePropertysRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByDeletedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilePropertysRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilePropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastProfilePropertyRelatedByDeletedByCriteria) || !$this->lastProfilePropertyRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfilePropertyRelatedByDeletedByCriteria = $criteria;
		return $this->collProfilePropertysRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related ProfilePropertysRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilePropertysRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

		return ProfilePropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ProfileProperty object to this object
	 * through the ProfileProperty foreign key attribute
	 *
	 * @param      ProfileProperty $l ProfileProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfilePropertyRelatedByDeletedBy(ProfileProperty $l)
	{
		$this->collProfilePropertysRelatedByDeletedBy[] = $l;
		$l->setUsersRelatedByDeletedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilePropertysRelatedByDeletedByJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByDeletedByCriteria) || !$this->lastProfilePropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilePropertysRelatedByDeletedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByDeletedByCriteria) || !$this->lastProfilePropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProfilePropertysRelatedByDeletedByJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByDeletedByCriteria) || !$this->lastProfilePropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByDeletedBy;
	}

	/**
	 * Temporary storage of collProjectUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProjectUsers()
	{
		if ($this->collProjectUsers === null) {
			$this->collProjectUsers = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ProjectUsers from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProjectUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProjectUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectUsers === null) {
			if ($this->isNew()) {
			   $this->collProjectUsers = array();
			} else {

				$criteria->add(ProjectUserPeer::USER_ID, $this->getId());

				ProjectUserPeer::addSelectColumns($criteria);
				$this->collProjectUsers = ProjectUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjectUserPeer::USER_ID, $this->getId());

				ProjectUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjectUserCriteria) || !$this->lastProjectUserCriteria->equals($criteria)) {
					$this->collProjectUsers = ProjectUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjectUserCriteria = $criteria;
		return $this->collProjectUsers;
	}

	/**
	 * Returns the number of related ProjectUsers.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProjectUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProjectUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProjectUserPeer::USER_ID, $this->getId());

		return ProjectUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ProjectUser object to this object
	 * through the ProjectUser foreign key attribute
	 *
	 * @param      ProjectUser $l ProjectUser
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProjectUser(ProjectUser $l)
	{
		$this->collProjectUsers[] = $l;
		$l->setUsers($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ProjectUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getProjectUsersJoinProjects($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProjectUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectUsers === null) {
			if ($this->isNew()) {
				$this->collProjectUsers = array();
			} else {

				$criteria->add(ProjectUserPeer::USER_ID, $this->getId());

				$this->collProjectUsers = ProjectUserPeer::doSelectJoinProjects($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjectUserPeer::USER_ID, $this->getId());

			if (!isset($this->lastProjectUserCriteria) || !$this->lastProjectUserCriteria->equals($criteria)) {
				$this->collProjectUsers = ProjectUserPeer::doSelectJoinProjects($criteria, $con);
			}
		}
		$this->lastProjectUserCriteria = $criteria;

		return $this->collProjectUsers;
	}

	/**
	 * Temporary storage of collProjectssRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProjectssRelatedByCreatedBy()
	{
		if ($this->collProjectssRelatedByCreatedBy === null) {
			$this->collProjectssRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ProjectssRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProjectssRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProjectsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectssRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collProjectssRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProjectsPeer::CREATED_BY, $this->getId());

				ProjectsPeer::addSelectColumns($criteria);
				$this->collProjectssRelatedByCreatedBy = ProjectsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjectsPeer::CREATED_BY, $this->getId());

				ProjectsPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjectsRelatedByCreatedByCriteria) || !$this->lastProjectsRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collProjectssRelatedByCreatedBy = ProjectsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjectsRelatedByCreatedByCriteria = $criteria;
		return $this->collProjectssRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related ProjectssRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProjectssRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProjectsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProjectsPeer::CREATED_BY, $this->getId());

		return ProjectsPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Projects object to this object
	 * through the Projects foreign key attribute
	 *
	 * @param      Projects $l Projects
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProjectsRelatedByCreatedBy(Projects $l)
	{
		$this->collProjectssRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}

	/**
	 * Temporary storage of collProjectssRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProjectssRelatedByUpdatedBy()
	{
		if ($this->collProjectssRelatedByUpdatedBy === null) {
			$this->collProjectssRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ProjectssRelatedByUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProjectssRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProjectsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectssRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collProjectssRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProjectsPeer::UPDATED_BY, $this->getId());

				ProjectsPeer::addSelectColumns($criteria);
				$this->collProjectssRelatedByUpdatedBy = ProjectsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjectsPeer::UPDATED_BY, $this->getId());

				ProjectsPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjectsRelatedByUpdatedByCriteria) || !$this->lastProjectsRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collProjectssRelatedByUpdatedBy = ProjectsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjectsRelatedByUpdatedByCriteria = $criteria;
		return $this->collProjectssRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related ProjectssRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProjectssRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProjectsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProjectsPeer::UPDATED_BY, $this->getId());

		return ProjectsPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Projects object to this object
	 * through the Projects foreign key attribute
	 *
	 * @param      Projects $l Projects
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProjectsRelatedByUpdatedBy(Projects $l)
	{
		$this->collProjectssRelatedByUpdatedBy[] = $l;
		$l->setUsersRelatedByUpdatedBy($this);
	}

	/**
	 * Temporary storage of collProjectssRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProjectssRelatedByDeletedBy()
	{
		if ($this->collProjectssRelatedByDeletedBy === null) {
			$this->collProjectssRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ProjectssRelatedByDeletedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProjectssRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProjectsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectssRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collProjectssRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProjectsPeer::DELETED_BY, $this->getId());

				ProjectsPeer::addSelectColumns($criteria);
				$this->collProjectssRelatedByDeletedBy = ProjectsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjectsPeer::DELETED_BY, $this->getId());

				ProjectsPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjectsRelatedByDeletedByCriteria) || !$this->lastProjectsRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collProjectssRelatedByDeletedBy = ProjectsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjectsRelatedByDeletedByCriteria = $criteria;
		return $this->collProjectssRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related ProjectssRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProjectssRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProjectsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProjectsPeer::DELETED_BY, $this->getId());

		return ProjectsPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Projects object to this object
	 * through the Projects foreign key attribute
	 *
	 * @param      Projects $l Projects
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProjectsRelatedByDeletedBy(Projects $l)
	{
		$this->collProjectssRelatedByDeletedBy[] = $l;
		$l->setUsersRelatedByDeletedBy($this);
	}

	/**
	 * Temporary storage of collAgentsRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initAgentsRelatedByCreatedBy()
	{
		if ($this->collAgentsRelatedByCreatedBy === null) {
			$this->collAgentsRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related AgentsRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getAgentsRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAgentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAgentsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collAgentsRelatedByCreatedBy = array();
			} else {

				$criteria->add(AgentPeer::CREATED_BY, $this->getId());

				AgentPeer::addSelectColumns($criteria);
				$this->collAgentsRelatedByCreatedBy = AgentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AgentPeer::CREATED_BY, $this->getId());

				AgentPeer::addSelectColumns($criteria);
				if (!isset($this->lastAgentRelatedByCreatedByCriteria) || !$this->lastAgentRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collAgentsRelatedByCreatedBy = AgentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAgentRelatedByCreatedByCriteria = $criteria;
		return $this->collAgentsRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related AgentsRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countAgentsRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAgentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AgentPeer::CREATED_BY, $this->getId());

		return AgentPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Agent object to this object
	 * through the Agent foreign key attribute
	 *
	 * @param      Agent $l Agent
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAgentRelatedByCreatedBy(Agent $l)
	{
		$this->collAgentsRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}

	/**
	 * Temporary storage of collAgentsRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initAgentsRelatedByUpdatedBy()
	{
		if ($this->collAgentsRelatedByUpdatedBy === null) {
			$this->collAgentsRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related AgentsRelatedByUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getAgentsRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAgentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAgentsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collAgentsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(AgentPeer::UPDATED_BY, $this->getId());

				AgentPeer::addSelectColumns($criteria);
				$this->collAgentsRelatedByUpdatedBy = AgentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AgentPeer::UPDATED_BY, $this->getId());

				AgentPeer::addSelectColumns($criteria);
				if (!isset($this->lastAgentRelatedByUpdatedByCriteria) || !$this->lastAgentRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collAgentsRelatedByUpdatedBy = AgentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAgentRelatedByUpdatedByCriteria = $criteria;
		return $this->collAgentsRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related AgentsRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countAgentsRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAgentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AgentPeer::UPDATED_BY, $this->getId());

		return AgentPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Agent object to this object
	 * through the Agent foreign key attribute
	 *
	 * @param      Agent $l Agent
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAgentRelatedByUpdatedBy(Agent $l)
	{
		$this->collAgentsRelatedByUpdatedBy[] = $l;
		$l->setUsersRelatedByUpdatedBy($this);
	}

	/**
	 * Temporary storage of collAgentsRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initAgentsRelatedByDeletedBy()
	{
		if ($this->collAgentsRelatedByDeletedBy === null) {
			$this->collAgentsRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related AgentsRelatedByDeletedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getAgentsRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAgentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAgentsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collAgentsRelatedByDeletedBy = array();
			} else {

				$criteria->add(AgentPeer::DELETED_BY, $this->getId());

				AgentPeer::addSelectColumns($criteria);
				$this->collAgentsRelatedByDeletedBy = AgentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AgentPeer::DELETED_BY, $this->getId());

				AgentPeer::addSelectColumns($criteria);
				if (!isset($this->lastAgentRelatedByDeletedByCriteria) || !$this->lastAgentRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collAgentsRelatedByDeletedBy = AgentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAgentRelatedByDeletedByCriteria = $criteria;
		return $this->collAgentsRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related AgentsRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countAgentsRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAgentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AgentPeer::DELETED_BY, $this->getId());

		return AgentPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Agent object to this object
	 * through the Agent foreign key attribute
	 *
	 * @param      Agent $l Agent
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAgentRelatedByDeletedBy(Agent $l)
	{
		$this->collAgentsRelatedByDeletedBy[] = $l;
		$l->setUsersRelatedByDeletedBy($this);
	}

	/**
	 * Temporary storage of collAgentHasUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initAgentHasUsers()
	{
		if ($this->collAgentHasUsers === null) {
			$this->collAgentHasUsers = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related AgentHasUsers from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getAgentHasUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAgentHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAgentHasUsers === null) {
			if ($this->isNew()) {
			   $this->collAgentHasUsers = array();
			} else {

				$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

				AgentHasUserPeer::addSelectColumns($criteria);
				$this->collAgentHasUsers = AgentHasUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

				AgentHasUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastAgentHasUserCriteria) || !$this->lastAgentHasUserCriteria->equals($criteria)) {
					$this->collAgentHasUsers = AgentHasUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAgentHasUserCriteria = $criteria;
		return $this->collAgentHasUsers;
	}

	/**
	 * Returns the number of related AgentHasUsers.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countAgentHasUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAgentHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

		return AgentHasUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a AgentHasUser object to this object
	 * through the AgentHasUser foreign key attribute
	 *
	 * @param      AgentHasUser $l AgentHasUser
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAgentHasUser(AgentHasUser $l)
	{
		$this->collAgentHasUsers[] = $l;
		$l->setUsers($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related AgentHasUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getAgentHasUsersJoinAgent($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAgentHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAgentHasUsers === null) {
			if ($this->isNew()) {
				$this->collAgentHasUsers = array();
			} else {

				$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

				$this->collAgentHasUsers = AgentHasUserPeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

			if (!isset($this->lastAgentHasUserCriteria) || !$this->lastAgentHasUserCriteria->equals($criteria)) {
				$this->collAgentHasUsers = AgentHasUserPeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastAgentHasUserCriteria = $criteria;

		return $this->collAgentHasUsers;
	}

	/**
	 * Temporary storage of collCollectionsRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCollectionsRelatedByCreatedUserId()
	{
		if ($this->collCollectionsRelatedByCreatedUserId === null) {
			$this->collCollectionsRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByCreatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCollectionsRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collCollectionsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				$this->collCollectionsRelatedByCreatedUserId = CollectionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCollectionRelatedByCreatedUserIdCriteria) || !$this->lastCollectionRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collCollectionsRelatedByCreatedUserId = CollectionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCollectionRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collCollectionsRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related CollectionsRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCollectionsRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

		return CollectionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Collection object to this object
	 * through the Collection foreign key attribute
	 *
	 * @param      Collection $l Collection
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCollectionRelatedByCreatedUserId(Collection $l)
	{
		$this->collCollectionsRelatedByCreatedUserId[] = $l;
		$l->setUsersRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getCollectionsRelatedByCreatedUserIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

				$this->collCollectionsRelatedByCreatedUserId = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastCollectionRelatedByCreatedUserIdCriteria) || !$this->lastCollectionRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByCreatedUserId = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collCollectionsRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getCollectionsRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

				$this->collCollectionsRelatedByCreatedUserId = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastCollectionRelatedByCreatedUserIdCriteria) || !$this->lastCollectionRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByCreatedUserId = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collCollectionsRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collCollectionsRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCollectionsRelatedByUpdatedUserId()
	{
		if ($this->collCollectionsRelatedByUpdatedUserId === null) {
			$this->collCollectionsRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByUpdatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCollectionsRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collCollectionsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				$this->collCollectionsRelatedByUpdatedUserId = CollectionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCollectionRelatedByUpdatedUserIdCriteria) || !$this->lastCollectionRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collCollectionsRelatedByUpdatedUserId = CollectionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCollectionRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collCollectionsRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related CollectionsRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCollectionsRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

		return CollectionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Collection object to this object
	 * through the Collection foreign key attribute
	 *
	 * @param      Collection $l Collection
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCollectionRelatedByUpdatedUserId(Collection $l)
	{
		$this->collCollectionsRelatedByUpdatedUserId[] = $l;
		$l->setUsersRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getCollectionsRelatedByUpdatedUserIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

				$this->collCollectionsRelatedByUpdatedUserId = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastCollectionRelatedByUpdatedUserIdCriteria) || !$this->lastCollectionRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByUpdatedUserId = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collCollectionsRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getCollectionsRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

				$this->collCollectionsRelatedByUpdatedUserId = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastCollectionRelatedByUpdatedUserIdCriteria) || !$this->lastCollectionRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByUpdatedUserId = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collCollectionsRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collCollectionsRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCollectionsRelatedByCreatedBy()
	{
		if ($this->collCollectionsRelatedByCreatedBy === null) {
			$this->collCollectionsRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCollectionsRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collCollectionsRelatedByCreatedBy = array();
			} else {

				$criteria->add(CollectionPeer::CREATED_BY, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				$this->collCollectionsRelatedByCreatedBy = CollectionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CollectionPeer::CREATED_BY, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCollectionRelatedByCreatedByCriteria) || !$this->lastCollectionRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collCollectionsRelatedByCreatedBy = CollectionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCollectionRelatedByCreatedByCriteria = $criteria;
		return $this->collCollectionsRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related CollectionsRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCollectionsRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CollectionPeer::CREATED_BY, $this->getId());

		return CollectionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Collection object to this object
	 * through the Collection foreign key attribute
	 *
	 * @param      Collection $l Collection
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCollectionRelatedByCreatedBy(Collection $l)
	{
		$this->collCollectionsRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getCollectionsRelatedByCreatedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByCreatedBy = array();
			} else {

				$criteria->add(CollectionPeer::CREATED_BY, $this->getId());

				$this->collCollectionsRelatedByCreatedBy = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastCollectionRelatedByCreatedByCriteria) || !$this->lastCollectionRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByCreatedBy = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByCreatedByCriteria = $criteria;

		return $this->collCollectionsRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getCollectionsRelatedByCreatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByCreatedBy = array();
			} else {

				$criteria->add(CollectionPeer::CREATED_BY, $this->getId());

				$this->collCollectionsRelatedByCreatedBy = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastCollectionRelatedByCreatedByCriteria) || !$this->lastCollectionRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByCreatedBy = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByCreatedByCriteria = $criteria;

		return $this->collCollectionsRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collCollectionsRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCollectionsRelatedByUpdatedBy()
	{
		if ($this->collCollectionsRelatedByUpdatedBy === null) {
			$this->collCollectionsRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCollectionsRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collCollectionsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(CollectionPeer::UPDATED_BY, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				$this->collCollectionsRelatedByUpdatedBy = CollectionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CollectionPeer::UPDATED_BY, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCollectionRelatedByUpdatedByCriteria) || !$this->lastCollectionRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collCollectionsRelatedByUpdatedBy = CollectionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCollectionRelatedByUpdatedByCriteria = $criteria;
		return $this->collCollectionsRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related CollectionsRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCollectionsRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CollectionPeer::UPDATED_BY, $this->getId());

		return CollectionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Collection object to this object
	 * through the Collection foreign key attribute
	 *
	 * @param      Collection $l Collection
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCollectionRelatedByUpdatedBy(Collection $l)
	{
		$this->collCollectionsRelatedByUpdatedBy[] = $l;
		$l->setUsersRelatedByUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getCollectionsRelatedByUpdatedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(CollectionPeer::UPDATED_BY, $this->getId());

				$this->collCollectionsRelatedByUpdatedBy = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastCollectionRelatedByUpdatedByCriteria) || !$this->lastCollectionRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByUpdatedBy = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByUpdatedByCriteria = $criteria;

		return $this->collCollectionsRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getCollectionsRelatedByUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(CollectionPeer::UPDATED_BY, $this->getId());

				$this->collCollectionsRelatedByUpdatedBy = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastCollectionRelatedByUpdatedByCriteria) || !$this->lastCollectionRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByUpdatedBy = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByUpdatedByCriteria = $criteria;

		return $this->collCollectionsRelatedByUpdatedBy;
	}

	/**
	 * Temporary storage of collCollectionsRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCollectionsRelatedByDeletedBy()
	{
		if ($this->collCollectionsRelatedByDeletedBy === null) {
			$this->collCollectionsRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByDeletedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCollectionsRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collCollectionsRelatedByDeletedBy = array();
			} else {

				$criteria->add(CollectionPeer::DELETED_BY, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				$this->collCollectionsRelatedByDeletedBy = CollectionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CollectionPeer::DELETED_BY, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCollectionRelatedByDeletedByCriteria) || !$this->lastCollectionRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collCollectionsRelatedByDeletedBy = CollectionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCollectionRelatedByDeletedByCriteria = $criteria;
		return $this->collCollectionsRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related CollectionsRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCollectionsRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CollectionPeer::DELETED_BY, $this->getId());

		return CollectionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Collection object to this object
	 * through the Collection foreign key attribute
	 *
	 * @param      Collection $l Collection
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCollectionRelatedByDeletedBy(Collection $l)
	{
		$this->collCollectionsRelatedByDeletedBy[] = $l;
		$l->setUsersRelatedByDeletedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getCollectionsRelatedByDeletedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByDeletedBy = array();
			} else {

				$criteria->add(CollectionPeer::DELETED_BY, $this->getId());

				$this->collCollectionsRelatedByDeletedBy = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastCollectionRelatedByDeletedByCriteria) || !$this->lastCollectionRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByDeletedBy = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByDeletedByCriteria = $criteria;

		return $this->collCollectionsRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related CollectionsRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getCollectionsRelatedByDeletedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollectionsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByDeletedBy = array();
			} else {

				$criteria->add(CollectionPeer::DELETED_BY, $this->getId());

				$this->collCollectionsRelatedByDeletedBy = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastCollectionRelatedByDeletedByCriteria) || !$this->lastCollectionRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByDeletedBy = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByDeletedByCriteria = $criteria;

		return $this->collCollectionsRelatedByDeletedBy;
	}

	/**
	 * Temporary storage of collConceptsRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptsRelatedByCreatedUserId()
	{
		if ($this->collConceptsRelatedByCreatedUserId === null) {
			$this->collConceptsRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByCreatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptsRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptRelatedByCreatedUserIdCriteria) || !$this->lastConceptRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collConceptsRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related ConceptsRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptsRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

		return ConceptPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Concept object to this object
	 * through the Concept foreign key attribute
	 *
	 * @param      Concept $l Concept
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptRelatedByCreatedUserId(Concept $l)
	{
		$this->collConceptsRelatedByCreatedUserId[] = $l;
		$l->setUsersRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByCreatedUserIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptRelatedByCreatedUserIdCriteria) || !$this->lastConceptRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptsRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByCreatedUserIdJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptRelatedByCreatedUserIdCriteria) || !$this->lastConceptRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptsRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptRelatedByCreatedUserIdCriteria) || !$this->lastConceptRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptsRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collConceptsRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptsRelatedByUpdatedUserId()
	{
		if ($this->collConceptsRelatedByUpdatedUserId === null) {
			$this->collConceptsRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByUpdatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptsRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptRelatedByUpdatedUserIdCriteria) || !$this->lastConceptRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collConceptsRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related ConceptsRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptsRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

		return ConceptPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Concept object to this object
	 * through the Concept foreign key attribute
	 *
	 * @param      Concept $l Concept
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptRelatedByUpdatedUserId(Concept $l)
	{
		$this->collConceptsRelatedByUpdatedUserId[] = $l;
		$l->setUsersRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByUpdatedUserIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptRelatedByUpdatedUserIdCriteria) || !$this->lastConceptRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptsRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByUpdatedUserIdJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptRelatedByUpdatedUserIdCriteria) || !$this->lastConceptRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptsRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptRelatedByUpdatedUserIdCriteria) || !$this->lastConceptRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptsRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collConceptsRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptsRelatedByCreatedBy()
	{
		if ($this->collConceptsRelatedByCreatedBy === null) {
			$this->collConceptsRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptsRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collConceptsRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPeer::CREATED_BY, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				$this->collConceptsRelatedByCreatedBy = ConceptPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPeer::CREATED_BY, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptRelatedByCreatedByCriteria) || !$this->lastConceptRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collConceptsRelatedByCreatedBy = ConceptPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptRelatedByCreatedByCriteria = $criteria;
		return $this->collConceptsRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related ConceptsRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptsRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPeer::CREATED_BY, $this->getId());

		return ConceptPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Concept object to this object
	 * through the Concept foreign key attribute
	 *
	 * @param      Concept $l Concept
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptRelatedByCreatedBy(Concept $l)
	{
		$this->collConceptsRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByCreatedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPeer::CREATED_BY, $this->getId());

				$this->collConceptsRelatedByCreatedBy = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptRelatedByCreatedByCriteria) || !$this->lastConceptRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptsRelatedByCreatedBy = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptsRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByCreatedByJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPeer::CREATED_BY, $this->getId());

				$this->collConceptsRelatedByCreatedBy = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptRelatedByCreatedByCriteria) || !$this->lastConceptRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptsRelatedByCreatedBy = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptsRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByCreatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPeer::CREATED_BY, $this->getId());

				$this->collConceptsRelatedByCreatedBy = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptRelatedByCreatedByCriteria) || !$this->lastConceptRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptsRelatedByCreatedBy = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptsRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collConceptsRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptsRelatedByUpdatedBy()
	{
		if ($this->collConceptsRelatedByUpdatedBy === null) {
			$this->collConceptsRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptsRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collConceptsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ConceptPeer::UPDATED_BY, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				$this->collConceptsRelatedByUpdatedBy = ConceptPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPeer::UPDATED_BY, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptRelatedByUpdatedByCriteria) || !$this->lastConceptRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collConceptsRelatedByUpdatedBy = ConceptPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptRelatedByUpdatedByCriteria = $criteria;
		return $this->collConceptsRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related ConceptsRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptsRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPeer::UPDATED_BY, $this->getId());

		return ConceptPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Concept object to this object
	 * through the Concept foreign key attribute
	 *
	 * @param      Concept $l Concept
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptRelatedByUpdatedBy(Concept $l)
	{
		$this->collConceptsRelatedByUpdatedBy[] = $l;
		$l->setUsersRelatedByUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByUpdatedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ConceptPeer::UPDATED_BY, $this->getId());

				$this->collConceptsRelatedByUpdatedBy = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastConceptRelatedByUpdatedByCriteria) || !$this->lastConceptRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collConceptsRelatedByUpdatedBy = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptRelatedByUpdatedByCriteria = $criteria;

		return $this->collConceptsRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByUpdatedByJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ConceptPeer::UPDATED_BY, $this->getId());

				$this->collConceptsRelatedByUpdatedBy = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastConceptRelatedByUpdatedByCriteria) || !$this->lastConceptRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collConceptsRelatedByUpdatedBy = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptRelatedByUpdatedByCriteria = $criteria;

		return $this->collConceptsRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ConceptPeer::UPDATED_BY, $this->getId());

				$this->collConceptsRelatedByUpdatedBy = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastConceptRelatedByUpdatedByCriteria) || !$this->lastConceptRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collConceptsRelatedByUpdatedBy = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptRelatedByUpdatedByCriteria = $criteria;

		return $this->collConceptsRelatedByUpdatedBy;
	}

	/**
	 * Temporary storage of collConceptsRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptsRelatedByDeletedBy()
	{
		if ($this->collConceptsRelatedByDeletedBy === null) {
			$this->collConceptsRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByDeletedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptsRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collConceptsRelatedByDeletedBy = array();
			} else {

				$criteria->add(ConceptPeer::DELETED_BY, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				$this->collConceptsRelatedByDeletedBy = ConceptPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPeer::DELETED_BY, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptRelatedByDeletedByCriteria) || !$this->lastConceptRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collConceptsRelatedByDeletedBy = ConceptPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptRelatedByDeletedByCriteria = $criteria;
		return $this->collConceptsRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related ConceptsRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptsRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPeer::DELETED_BY, $this->getId());

		return ConceptPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Concept object to this object
	 * through the Concept foreign key attribute
	 *
	 * @param      Concept $l Concept
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptRelatedByDeletedBy(Concept $l)
	{
		$this->collConceptsRelatedByDeletedBy[] = $l;
		$l->setUsersRelatedByDeletedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByDeletedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByDeletedBy = array();
			} else {

				$criteria->add(ConceptPeer::DELETED_BY, $this->getId());

				$this->collConceptsRelatedByDeletedBy = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastConceptRelatedByDeletedByCriteria) || !$this->lastConceptRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collConceptsRelatedByDeletedBy = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptRelatedByDeletedByCriteria = $criteria;

		return $this->collConceptsRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByDeletedByJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByDeletedBy = array();
			} else {

				$criteria->add(ConceptPeer::DELETED_BY, $this->getId());

				$this->collConceptsRelatedByDeletedBy = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastConceptRelatedByDeletedByCriteria) || !$this->lastConceptRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collConceptsRelatedByDeletedBy = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptRelatedByDeletedByCriteria = $criteria;

		return $this->collConceptsRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptsRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptsRelatedByDeletedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByDeletedBy = array();
			} else {

				$criteria->add(ConceptPeer::DELETED_BY, $this->getId());

				$this->collConceptsRelatedByDeletedBy = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastConceptRelatedByDeletedByCriteria) || !$this->lastConceptRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collConceptsRelatedByDeletedBy = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptRelatedByDeletedByCriteria = $criteria;

		return $this->collConceptsRelatedByDeletedBy;
	}

	/**
	 * Temporary storage of collConceptPropertysRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertysRelatedByCreatedUserId()
	{
		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			$this->collConceptPropertysRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertysRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collConceptPropertysRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related ConceptPropertysRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertysRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ConceptProperty object to this object
	 * through the ConceptProperty foreign key attribute
	 *
	 * @param      ConceptProperty $l ConceptProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptPropertyRelatedByCreatedUserId(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByCreatedUserId[] = $l;
		$l->setUsersRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByCreatedUserIdJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByCreatedUserIdJoinProfilePropertyRelatedBySkosPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedBySkosPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedBySkosPropertyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByCreatedUserIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByCreatedUserIdJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByCreatedUserIdJoinProfilePropertyRelatedByProfilePropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedByProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedByProfilePropertyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collConceptPropertysRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertysRelatedByUpdatedUserId()
	{
		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			$this->collConceptPropertysRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertysRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related ConceptPropertysRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertysRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ConceptProperty object to this object
	 * through the ConceptProperty foreign key attribute
	 *
	 * @param      ConceptProperty $l ConceptProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptPropertyRelatedByUpdatedUserId(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByUpdatedUserId[] = $l;
		$l->setUsersRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByUpdatedUserIdJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByUpdatedUserIdJoinProfilePropertyRelatedBySkosPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedBySkosPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedBySkosPropertyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByUpdatedUserIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByUpdatedUserIdJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByUpdatedUserIdJoinProfilePropertyRelatedByProfilePropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedByProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedByProfilePropertyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collConceptPropertysRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertysRelatedByCreatedBy()
	{
		if ($this->collConceptPropertysRelatedByCreatedBy === null) {
			$this->collConceptPropertysRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertysRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByCreatedByCriteria) || !$this->lastConceptPropertyRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByCreatedByCriteria = $criteria;
		return $this->collConceptPropertysRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related ConceptPropertysRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertysRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ConceptProperty object to this object
	 * through the ConceptProperty foreign key attribute
	 *
	 * @param      ConceptProperty $l ConceptProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptPropertyRelatedByCreatedBy(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByCreatedByJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedByCriteria) || !$this->lastConceptPropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByCreatedByJoinProfilePropertyRelatedBySkosPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedBySkosPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedByCriteria) || !$this->lastConceptPropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedBySkosPropertyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByCreatedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedByCriteria) || !$this->lastConceptPropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByCreatedByJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedByCriteria) || !$this->lastConceptPropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByCreatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedByCriteria) || !$this->lastConceptPropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByCreatedByJoinProfilePropertyRelatedByProfilePropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedByProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedByCriteria) || !$this->lastConceptPropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedBy = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedByProfilePropertyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collConceptPropertysRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertysRelatedByUpdatedBy()
	{
		if ($this->collConceptPropertysRelatedByUpdatedBy === null) {
			$this->collConceptPropertysRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertysRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByUpdatedByCriteria) || !$this->lastConceptPropertyRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedByCriteria = $criteria;
		return $this->collConceptPropertysRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related ConceptPropertysRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertysRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ConceptProperty object to this object
	 * through the ConceptProperty foreign key attribute
	 *
	 * @param      ConceptProperty $l ConceptProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptPropertyRelatedByUpdatedBy(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByUpdatedBy[] = $l;
		$l->setUsersRelatedByUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByUpdatedByJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedByCriteria) || !$this->lastConceptPropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByUpdatedByJoinProfilePropertyRelatedBySkosPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedBySkosPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedByCriteria) || !$this->lastConceptPropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedBySkosPropertyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByUpdatedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedByCriteria) || !$this->lastConceptPropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByUpdatedByJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedByCriteria) || !$this->lastConceptPropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedByCriteria) || !$this->lastConceptPropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByUpdatedByJoinProfilePropertyRelatedByProfilePropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedByProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedByCriteria) || !$this->lastConceptPropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedBy = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedByProfilePropertyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedBy;
	}

	/**
	 * Temporary storage of collConceptPropertysRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertysRelatedByDeletedBy()
	{
		if ($this->collConceptPropertysRelatedByDeletedBy === null) {
			$this->collConceptPropertysRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByDeletedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertysRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByDeletedByCriteria) || !$this->lastConceptPropertyRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByDeletedByCriteria = $criteria;
		return $this->collConceptPropertysRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related ConceptPropertysRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertysRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ConceptProperty object to this object
	 * through the ConceptProperty foreign key attribute
	 *
	 * @param      ConceptProperty $l ConceptProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptPropertyRelatedByDeletedBy(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByDeletedBy[] = $l;
		$l->setUsersRelatedByDeletedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByDeletedByJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByDeletedByCriteria) || !$this->lastConceptPropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByDeletedByJoinProfilePropertyRelatedBySkosPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedBySkosPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByDeletedByCriteria) || !$this->lastConceptPropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedBySkosPropertyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByDeletedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByDeletedByCriteria) || !$this->lastConceptPropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByDeletedByJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByDeletedByCriteria) || !$this->lastConceptPropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByDeletedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByDeletedByCriteria) || !$this->lastConceptPropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertysRelatedByDeletedByJoinProfilePropertyRelatedByProfilePropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedByProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByDeletedByCriteria) || !$this->lastConceptPropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByDeletedBy = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedByProfilePropertyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collConceptPropertysRelatedByDeletedBy;
	}

	/**
	 * Temporary storage of collConceptPropertyHistorysRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertyHistorysRelatedByCreatedUserId()
	{
		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertyHistorysRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related ConceptPropertyHistorysRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertyHistorysRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

		return ConceptPropertyHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ConceptPropertyHistory object to this object
	 * through the ConceptPropertyHistory foreign key attribute
	 *
	 * @param      ConceptPropertyHistory $l ConceptPropertyHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptPropertyHistoryRelatedByCreatedUserId(ConceptPropertyHistory $l)
	{
		$this->collConceptPropertyHistorysRelatedByCreatedUserId[] = $l;
		$l->setUsersRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinVocabularyRelatedByVocabularyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedByVocabularyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedByVocabularyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinSkosProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinVocabularyRelatedBySchemeId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedBySchemeId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedBySchemeId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinFileImportHistory($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinProfileProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collConceptPropertyHistorysRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertyHistorysRelatedByCreatedBy()
	{
		if ($this->collConceptPropertyHistorysRelatedByCreatedBy === null) {
			$this->collConceptPropertyHistorysRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertyHistorysRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertyHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedByCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria = $criteria;
		return $this->collConceptPropertyHistorysRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related ConceptPropertyHistorysRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertyHistorysRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

		return ConceptPropertyHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ConceptPropertyHistory object to this object
	 * through the ConceptPropertyHistory foreign key attribute
	 *
	 * @param      ConceptPropertyHistory $l ConceptPropertyHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptPropertyHistoryRelatedByCreatedBy(ConceptPropertyHistory $l)
	{
		$this->collConceptPropertyHistorysRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedByJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedByCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedByJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedByCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedByJoinVocabularyRelatedByVocabularyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedByVocabularyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedByCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedByVocabularyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedByJoinSkosProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedByCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedByJoinVocabularyRelatedBySchemeId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedBySchemeId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedByCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedBySchemeId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedByJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedByCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedByCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedByJoinFileImportHistory($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedByCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getConceptPropertyHistorysRelatedByCreatedByJoinProfileProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedByCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedBy = ConceptPropertyHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collDiscusssRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDiscusssRelatedByCreatedUserId()
	{
		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			$this->collDiscusssRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getDiscusssRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collDiscusssRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related DiscusssRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countDiscusssRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

		return DiscussPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Discuss object to this object
	 * through the Discuss foreign key attribute
	 *
	 * @param      Discuss $l Discuss
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDiscussRelatedByCreatedUserId(Discuss $l)
	{
		$this->collDiscusssRelatedByCreatedUserId[] = $l;
		$l->setUsersRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinSchemaProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinSchemaPropertyElement($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinConcept($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinDiscussRelatedByRootId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinDiscussRelatedByParentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collDiscusssRelatedByDeletedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDiscusssRelatedByDeletedUserId()
	{
		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			$this->collDiscusssRelatedByDeletedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getDiscusssRelatedByDeletedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
			   $this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
					$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;
		return $this->collDiscusssRelatedByDeletedUserId;
	}

	/**
	 * Returns the number of related DiscusssRelatedByDeletedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countDiscusssRelatedByDeletedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

		return DiscussPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Discuss object to this object
	 * through the Discuss foreign key attribute
	 *
	 * @param      Discuss $l Discuss
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDiscussRelatedByDeletedUserId(Discuss $l)
	{
		$this->collDiscusssRelatedByDeletedUserId[] = $l;
		$l->setUsersRelatedByDeletedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinSchemaProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinSchemaPropertyElement($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinConcept($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinDiscussRelatedByRootId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinDiscussRelatedByParentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}

	/**
	 * Temporary storage of collDiscusssRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDiscusssRelatedByCreatedBy()
	{
		if ($this->collDiscusssRelatedByCreatedBy === null) {
			$this->collDiscusssRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getDiscusssRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collDiscusssRelatedByCreatedBy = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				if (!isset($this->lastDiscussRelatedByCreatedByCriteria) || !$this->lastDiscussRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDiscussRelatedByCreatedByCriteria = $criteria;
		return $this->collDiscusssRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related DiscusssRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countDiscusssRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

		return DiscussPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Discuss object to this object
	 * through the Discuss foreign key attribute
	 *
	 * @param      Discuss $l Discuss
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDiscussRelatedByCreatedBy(Discuss $l)
	{
		$this->collDiscusssRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedByJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedBy = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedByCriteria) || !$this->lastDiscussRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedByCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedByJoinSchemaProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedBy = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedByCriteria) || !$this->lastDiscussRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedByCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedByJoinSchemaPropertyElement($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedBy = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedByCriteria) || !$this->lastDiscussRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedByCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedBy = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedByCriteria) || !$this->lastDiscussRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedByCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedByJoinConcept($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedBy = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedByCriteria) || !$this->lastDiscussRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedByCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedByJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedBy = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedByCriteria) || !$this->lastDiscussRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedByCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedByJoinDiscussRelatedByRootId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedBy = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedByCriteria) || !$this->lastDiscussRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedByCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByCreatedByJoinDiscussRelatedByParentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedBy = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedByCriteria) || !$this->lastDiscussRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedBy = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedByCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collDiscusssRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDiscusssRelatedByDeletedBy()
	{
		if ($this->collDiscusssRelatedByDeletedBy === null) {
			$this->collDiscusssRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getDiscusssRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collDiscusssRelatedByDeletedBy = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				if (!isset($this->lastDiscussRelatedByDeletedByCriteria) || !$this->lastDiscussRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDiscussRelatedByDeletedByCriteria = $criteria;
		return $this->collDiscusssRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related DiscusssRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countDiscusssRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

		return DiscussPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Discuss object to this object
	 * through the Discuss foreign key attribute
	 *
	 * @param      Discuss $l Discuss
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDiscussRelatedByDeletedBy(Discuss $l)
	{
		$this->collDiscusssRelatedByDeletedBy[] = $l;
		$l->setUsersRelatedByDeletedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedByJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedBy = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedByCriteria) || !$this->lastDiscussRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedByCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedByJoinSchemaProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedBy = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedByCriteria) || !$this->lastDiscussRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedByCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedByJoinSchemaPropertyElement($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedBy = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedByCriteria) || !$this->lastDiscussRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedByCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedBy = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedByCriteria) || !$this->lastDiscussRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedByCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedByJoinConcept($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedBy = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedByCriteria) || !$this->lastDiscussRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedByCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedByJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedBy = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedByCriteria) || !$this->lastDiscussRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedByCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedByJoinDiscussRelatedByRootId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedBy = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedByCriteria) || !$this->lastDiscussRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedByCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getDiscusssRelatedByDeletedByJoinDiscussRelatedByParentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedBy = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedByCriteria) || !$this->lastDiscussRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedBy = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedByCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedBy;
	}

	/**
	 * Temporary storage of collExportHistorysRelatedByUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initExportHistorysRelatedByUserId()
	{
		if ($this->collExportHistorysRelatedByUserId === null) {
			$this->collExportHistorysRelatedByUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ExportHistorysRelatedByUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getExportHistorysRelatedByUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorysRelatedByUserId === null) {
			if ($this->isNew()) {
			   $this->collExportHistorysRelatedByUserId = array();
			} else {

				$criteria->add(ExportHistoryPeer::USER_ID, $this->getId());

				ExportHistoryPeer::addSelectColumns($criteria);
				$this->collExportHistorysRelatedByUserId = ExportHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ExportHistoryPeer::USER_ID, $this->getId());

				ExportHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastExportHistoryRelatedByUserIdCriteria) || !$this->lastExportHistoryRelatedByUserIdCriteria->equals($criteria)) {
					$this->collExportHistorysRelatedByUserId = ExportHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastExportHistoryRelatedByUserIdCriteria = $criteria;
		return $this->collExportHistorysRelatedByUserId;
	}

	/**
	 * Returns the number of related ExportHistorysRelatedByUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countExportHistorysRelatedByUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ExportHistoryPeer::USER_ID, $this->getId());

		return ExportHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ExportHistory object to this object
	 * through the ExportHistory foreign key attribute
	 *
	 * @param      ExportHistory $l ExportHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addExportHistoryRelatedByUserId(ExportHistory $l)
	{
		$this->collExportHistorysRelatedByUserId[] = $l;
		$l->setUsersRelatedByUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ExportHistorysRelatedByUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getExportHistorysRelatedByUserIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorysRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collExportHistorysRelatedByUserId = array();
			} else {

				$criteria->add(ExportHistoryPeer::USER_ID, $this->getId());

				$this->collExportHistorysRelatedByUserId = ExportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::USER_ID, $this->getId());

			if (!isset($this->lastExportHistoryRelatedByUserIdCriteria) || !$this->lastExportHistoryRelatedByUserIdCriteria->equals($criteria)) {
				$this->collExportHistorysRelatedByUserId = ExportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastExportHistoryRelatedByUserIdCriteria = $criteria;

		return $this->collExportHistorysRelatedByUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ExportHistorysRelatedByUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getExportHistorysRelatedByUserIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorysRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collExportHistorysRelatedByUserId = array();
			} else {

				$criteria->add(ExportHistoryPeer::USER_ID, $this->getId());

				$this->collExportHistorysRelatedByUserId = ExportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::USER_ID, $this->getId());

			if (!isset($this->lastExportHistoryRelatedByUserIdCriteria) || !$this->lastExportHistoryRelatedByUserIdCriteria->equals($criteria)) {
				$this->collExportHistorysRelatedByUserId = ExportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastExportHistoryRelatedByUserIdCriteria = $criteria;

		return $this->collExportHistorysRelatedByUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ExportHistorysRelatedByUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getExportHistorysRelatedByUserIdJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorysRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collExportHistorysRelatedByUserId = array();
			} else {

				$criteria->add(ExportHistoryPeer::USER_ID, $this->getId());

				$this->collExportHistorysRelatedByUserId = ExportHistoryPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::USER_ID, $this->getId());

			if (!isset($this->lastExportHistoryRelatedByUserIdCriteria) || !$this->lastExportHistoryRelatedByUserIdCriteria->equals($criteria)) {
				$this->collExportHistorysRelatedByUserId = ExportHistoryPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastExportHistoryRelatedByUserIdCriteria = $criteria;

		return $this->collExportHistorysRelatedByUserId;
	}

	/**
	 * Temporary storage of collExportHistorysRelatedByExportedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initExportHistorysRelatedByExportedBy()
	{
		if ($this->collExportHistorysRelatedByExportedBy === null) {
			$this->collExportHistorysRelatedByExportedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related ExportHistorysRelatedByExportedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getExportHistorysRelatedByExportedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorysRelatedByExportedBy === null) {
			if ($this->isNew()) {
			   $this->collExportHistorysRelatedByExportedBy = array();
			} else {

				$criteria->add(ExportHistoryPeer::EXPORTED_BY, $this->getId());

				ExportHistoryPeer::addSelectColumns($criteria);
				$this->collExportHistorysRelatedByExportedBy = ExportHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ExportHistoryPeer::EXPORTED_BY, $this->getId());

				ExportHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastExportHistoryRelatedByExportedByCriteria) || !$this->lastExportHistoryRelatedByExportedByCriteria->equals($criteria)) {
					$this->collExportHistorysRelatedByExportedBy = ExportHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastExportHistoryRelatedByExportedByCriteria = $criteria;
		return $this->collExportHistorysRelatedByExportedBy;
	}

	/**
	 * Returns the number of related ExportHistorysRelatedByExportedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countExportHistorysRelatedByExportedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ExportHistoryPeer::EXPORTED_BY, $this->getId());

		return ExportHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ExportHistory object to this object
	 * through the ExportHistory foreign key attribute
	 *
	 * @param      ExportHistory $l ExportHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addExportHistoryRelatedByExportedBy(ExportHistory $l)
	{
		$this->collExportHistorysRelatedByExportedBy[] = $l;
		$l->setUsersRelatedByExportedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ExportHistorysRelatedByExportedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getExportHistorysRelatedByExportedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorysRelatedByExportedBy === null) {
			if ($this->isNew()) {
				$this->collExportHistorysRelatedByExportedBy = array();
			} else {

				$criteria->add(ExportHistoryPeer::EXPORTED_BY, $this->getId());

				$this->collExportHistorysRelatedByExportedBy = ExportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::EXPORTED_BY, $this->getId());

			if (!isset($this->lastExportHistoryRelatedByExportedByCriteria) || !$this->lastExportHistoryRelatedByExportedByCriteria->equals($criteria)) {
				$this->collExportHistorysRelatedByExportedBy = ExportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastExportHistoryRelatedByExportedByCriteria = $criteria;

		return $this->collExportHistorysRelatedByExportedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ExportHistorysRelatedByExportedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getExportHistorysRelatedByExportedByJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorysRelatedByExportedBy === null) {
			if ($this->isNew()) {
				$this->collExportHistorysRelatedByExportedBy = array();
			} else {

				$criteria->add(ExportHistoryPeer::EXPORTED_BY, $this->getId());

				$this->collExportHistorysRelatedByExportedBy = ExportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::EXPORTED_BY, $this->getId());

			if (!isset($this->lastExportHistoryRelatedByExportedByCriteria) || !$this->lastExportHistoryRelatedByExportedByCriteria->equals($criteria)) {
				$this->collExportHistorysRelatedByExportedBy = ExportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastExportHistoryRelatedByExportedByCriteria = $criteria;

		return $this->collExportHistorysRelatedByExportedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related ExportHistorysRelatedByExportedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getExportHistorysRelatedByExportedByJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorysRelatedByExportedBy === null) {
			if ($this->isNew()) {
				$this->collExportHistorysRelatedByExportedBy = array();
			} else {

				$criteria->add(ExportHistoryPeer::EXPORTED_BY, $this->getId());

				$this->collExportHistorysRelatedByExportedBy = ExportHistoryPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::EXPORTED_BY, $this->getId());

			if (!isset($this->lastExportHistoryRelatedByExportedByCriteria) || !$this->lastExportHistoryRelatedByExportedByCriteria->equals($criteria)) {
				$this->collExportHistorysRelatedByExportedBy = ExportHistoryPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastExportHistoryRelatedByExportedByCriteria = $criteria;

		return $this->collExportHistorysRelatedByExportedBy;
	}

	/**
	 * Temporary storage of collFileImportHistorysRelatedByUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFileImportHistorysRelatedByUserId()
	{
		if ($this->collFileImportHistorysRelatedByUserId === null) {
			$this->collFileImportHistorysRelatedByUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related FileImportHistorysRelatedByUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFileImportHistorysRelatedByUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorysRelatedByUserId === null) {
			if ($this->isNew()) {
			   $this->collFileImportHistorysRelatedByUserId = array();
			} else {

				$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

				FileImportHistoryPeer::addSelectColumns($criteria);
				$this->collFileImportHistorysRelatedByUserId = FileImportHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

				FileImportHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastFileImportHistoryRelatedByUserIdCriteria) || !$this->lastFileImportHistoryRelatedByUserIdCriteria->equals($criteria)) {
					$this->collFileImportHistorysRelatedByUserId = FileImportHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileImportHistoryRelatedByUserIdCriteria = $criteria;
		return $this->collFileImportHistorysRelatedByUserId;
	}

	/**
	 * Returns the number of related FileImportHistorysRelatedByUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFileImportHistorysRelatedByUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

		return FileImportHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a FileImportHistory object to this object
	 * through the FileImportHistory foreign key attribute
	 *
	 * @param      FileImportHistory $l FileImportHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFileImportHistoryRelatedByUserId(FileImportHistory $l)
	{
		$this->collFileImportHistorysRelatedByUserId[] = $l;
		$l->setUsersRelatedByUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related FileImportHistorysRelatedByUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getFileImportHistorysRelatedByUserIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorysRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorysRelatedByUserId = array();
			} else {

				$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

				$this->collFileImportHistorysRelatedByUserId = FileImportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryRelatedByUserIdCriteria) || !$this->lastFileImportHistoryRelatedByUserIdCriteria->equals($criteria)) {
				$this->collFileImportHistorysRelatedByUserId = FileImportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastFileImportHistoryRelatedByUserIdCriteria = $criteria;

		return $this->collFileImportHistorysRelatedByUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related FileImportHistorysRelatedByUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getFileImportHistorysRelatedByUserIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorysRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorysRelatedByUserId = array();
			} else {

				$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

				$this->collFileImportHistorysRelatedByUserId = FileImportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryRelatedByUserIdCriteria) || !$this->lastFileImportHistoryRelatedByUserIdCriteria->equals($criteria)) {
				$this->collFileImportHistorysRelatedByUserId = FileImportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastFileImportHistoryRelatedByUserIdCriteria = $criteria;

		return $this->collFileImportHistorysRelatedByUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related FileImportHistorysRelatedByUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getFileImportHistorysRelatedByUserIdJoinBatch($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorysRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorysRelatedByUserId = array();
			} else {

				$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

				$this->collFileImportHistorysRelatedByUserId = FileImportHistoryPeer::doSelectJoinBatch($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryRelatedByUserIdCriteria) || !$this->lastFileImportHistoryRelatedByUserIdCriteria->equals($criteria)) {
				$this->collFileImportHistorysRelatedByUserId = FileImportHistoryPeer::doSelectJoinBatch($criteria, $con);
			}
		}
		$this->lastFileImportHistoryRelatedByUserIdCriteria = $criteria;

		return $this->collFileImportHistorysRelatedByUserId;
	}

	/**
	 * Temporary storage of collFileImportHistorysRelatedByImportedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFileImportHistorysRelatedByImportedBy()
	{
		if ($this->collFileImportHistorysRelatedByImportedBy === null) {
			$this->collFileImportHistorysRelatedByImportedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related FileImportHistorysRelatedByImportedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFileImportHistorysRelatedByImportedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorysRelatedByImportedBy === null) {
			if ($this->isNew()) {
			   $this->collFileImportHistorysRelatedByImportedBy = array();
			} else {

				$criteria->add(FileImportHistoryPeer::IMPORTED_BY, $this->getId());

				FileImportHistoryPeer::addSelectColumns($criteria);
				$this->collFileImportHistorysRelatedByImportedBy = FileImportHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FileImportHistoryPeer::IMPORTED_BY, $this->getId());

				FileImportHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastFileImportHistoryRelatedByImportedByCriteria) || !$this->lastFileImportHistoryRelatedByImportedByCriteria->equals($criteria)) {
					$this->collFileImportHistorysRelatedByImportedBy = FileImportHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileImportHistoryRelatedByImportedByCriteria = $criteria;
		return $this->collFileImportHistorysRelatedByImportedBy;
	}

	/**
	 * Returns the number of related FileImportHistorysRelatedByImportedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFileImportHistorysRelatedByImportedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FileImportHistoryPeer::IMPORTED_BY, $this->getId());

		return FileImportHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a FileImportHistory object to this object
	 * through the FileImportHistory foreign key attribute
	 *
	 * @param      FileImportHistory $l FileImportHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFileImportHistoryRelatedByImportedBy(FileImportHistory $l)
	{
		$this->collFileImportHistorysRelatedByImportedBy[] = $l;
		$l->setUsersRelatedByImportedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related FileImportHistorysRelatedByImportedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getFileImportHistorysRelatedByImportedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorysRelatedByImportedBy === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorysRelatedByImportedBy = array();
			} else {

				$criteria->add(FileImportHistoryPeer::IMPORTED_BY, $this->getId());

				$this->collFileImportHistorysRelatedByImportedBy = FileImportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::IMPORTED_BY, $this->getId());

			if (!isset($this->lastFileImportHistoryRelatedByImportedByCriteria) || !$this->lastFileImportHistoryRelatedByImportedByCriteria->equals($criteria)) {
				$this->collFileImportHistorysRelatedByImportedBy = FileImportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastFileImportHistoryRelatedByImportedByCriteria = $criteria;

		return $this->collFileImportHistorysRelatedByImportedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related FileImportHistorysRelatedByImportedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getFileImportHistorysRelatedByImportedByJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorysRelatedByImportedBy === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorysRelatedByImportedBy = array();
			} else {

				$criteria->add(FileImportHistoryPeer::IMPORTED_BY, $this->getId());

				$this->collFileImportHistorysRelatedByImportedBy = FileImportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::IMPORTED_BY, $this->getId());

			if (!isset($this->lastFileImportHistoryRelatedByImportedByCriteria) || !$this->lastFileImportHistoryRelatedByImportedByCriteria->equals($criteria)) {
				$this->collFileImportHistorysRelatedByImportedBy = FileImportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastFileImportHistoryRelatedByImportedByCriteria = $criteria;

		return $this->collFileImportHistorysRelatedByImportedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related FileImportHistorysRelatedByImportedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getFileImportHistorysRelatedByImportedByJoinBatch($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorysRelatedByImportedBy === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorysRelatedByImportedBy = array();
			} else {

				$criteria->add(FileImportHistoryPeer::IMPORTED_BY, $this->getId());

				$this->collFileImportHistorysRelatedByImportedBy = FileImportHistoryPeer::doSelectJoinBatch($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::IMPORTED_BY, $this->getId());

			if (!isset($this->lastFileImportHistoryRelatedByImportedByCriteria) || !$this->lastFileImportHistoryRelatedByImportedByCriteria->equals($criteria)) {
				$this->collFileImportHistorysRelatedByImportedBy = FileImportHistoryPeer::doSelectJoinBatch($criteria, $con);
			}
		}
		$this->lastFileImportHistoryRelatedByImportedByCriteria = $criteria;

		return $this->collFileImportHistorysRelatedByImportedBy;
	}

	/**
	 * Temporary storage of collSchemasRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemasRelatedByCreatedUserId()
	{
		if ($this->collSchemasRelatedByCreatedUserId === null) {
			$this->collSchemasRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemasRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemasRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaRelatedByCreatedUserIdCriteria) || !$this->lastSchemaRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collSchemasRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related SchemasRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemasRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

		return SchemaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Schema object to this object
	 * through the Schema foreign key attribute
	 *
	 * @param      Schema $l Schema
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaRelatedByCreatedUserId(Schema $l)
	{
		$this->collSchemasRelatedByCreatedUserId[] = $l;
		$l->setUsersRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByCreatedUserIdJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByCreatedUserIdCriteria) || !$this->lastSchemaRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByCreatedUserIdJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByCreatedUserIdCriteria) || !$this->lastSchemaRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByCreatedUserIdCriteria) || !$this->lastSchemaRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByCreatedUserIdJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByCreatedUserIdCriteria) || !$this->lastSchemaRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collSchemasRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemasRelatedByUpdatedUserId()
	{
		if ($this->collSchemasRelatedByUpdatedUserId === null) {
			$this->collSchemasRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemasRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemasRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collSchemasRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related SchemasRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemasRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

		return SchemaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Schema object to this object
	 * through the Schema foreign key attribute
	 *
	 * @param      Schema $l Schema
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaRelatedByUpdatedUserId(Schema $l)
	{
		$this->collSchemasRelatedByUpdatedUserId[] = $l;
		$l->setUsersRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByUpdatedUserIdJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByUpdatedUserIdJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByUpdatedUserIdJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collSchemasRelatedByDeletedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemasRelatedByDeletedUserId()
	{
		if ($this->collSchemasRelatedByDeletedUserId === null) {
			$this->collSchemasRelatedByDeletedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByDeletedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemasRelatedByDeletedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemasRelatedByDeletedUserId = array();
			} else {

				$criteria->add(SchemaPeer::DELETED_USER_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				$this->collSchemasRelatedByDeletedUserId = SchemaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPeer::DELETED_USER_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaRelatedByDeletedUserIdCriteria) || !$this->lastSchemaRelatedByDeletedUserIdCriteria->equals($criteria)) {
					$this->collSchemasRelatedByDeletedUserId = SchemaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaRelatedByDeletedUserIdCriteria = $criteria;
		return $this->collSchemasRelatedByDeletedUserId;
	}

	/**
	 * Returns the number of related SchemasRelatedByDeletedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemasRelatedByDeletedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPeer::DELETED_USER_ID, $this->getId());

		return SchemaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Schema object to this object
	 * through the Schema foreign key attribute
	 *
	 * @param      Schema $l Schema
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaRelatedByDeletedUserId(Schema $l)
	{
		$this->collSchemasRelatedByDeletedUserId[] = $l;
		$l->setUsersRelatedByDeletedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByDeletedUserIdJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByDeletedUserId = array();
			} else {

				$criteria->add(SchemaPeer::DELETED_USER_ID, $this->getId());

				$this->collSchemasRelatedByDeletedUserId = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByDeletedUserIdCriteria) || !$this->lastSchemaRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByDeletedUserId = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByDeletedUserIdJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByDeletedUserId = array();
			} else {

				$criteria->add(SchemaPeer::DELETED_USER_ID, $this->getId());

				$this->collSchemasRelatedByDeletedUserId = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByDeletedUserIdCriteria) || !$this->lastSchemaRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByDeletedUserId = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByDeletedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByDeletedUserId = array();
			} else {

				$criteria->add(SchemaPeer::DELETED_USER_ID, $this->getId());

				$this->collSchemasRelatedByDeletedUserId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByDeletedUserIdCriteria) || !$this->lastSchemaRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByDeletedUserId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByDeletedUserIdJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByDeletedUserId = array();
			} else {

				$criteria->add(SchemaPeer::DELETED_USER_ID, $this->getId());

				$this->collSchemasRelatedByDeletedUserId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByDeletedUserIdCriteria) || !$this->lastSchemaRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByDeletedUserId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByDeletedUserId;
	}

	/**
	 * Temporary storage of collSchemasRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemasRelatedByCreatedBy()
	{
		if ($this->collSchemasRelatedByCreatedBy === null) {
			$this->collSchemasRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemasRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collSchemasRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_BY, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				$this->collSchemasRelatedByCreatedBy = SchemaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPeer::CREATED_BY, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaRelatedByCreatedByCriteria) || !$this->lastSchemaRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collSchemasRelatedByCreatedBy = SchemaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaRelatedByCreatedByCriteria = $criteria;
		return $this->collSchemasRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related SchemasRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemasRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPeer::CREATED_BY, $this->getId());

		return SchemaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Schema object to this object
	 * through the Schema foreign key attribute
	 *
	 * @param      Schema $l Schema
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaRelatedByCreatedBy(Schema $l)
	{
		$this->collSchemasRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByCreatedByJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_BY, $this->getId());

				$this->collSchemasRelatedByCreatedBy = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaRelatedByCreatedByCriteria) || !$this->lastSchemaRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemasRelatedByCreatedBy = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemasRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByCreatedByJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_BY, $this->getId());

				$this->collSchemasRelatedByCreatedBy = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaRelatedByCreatedByCriteria) || !$this->lastSchemaRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemasRelatedByCreatedBy = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemasRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByCreatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_BY, $this->getId());

				$this->collSchemasRelatedByCreatedBy = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaRelatedByCreatedByCriteria) || !$this->lastSchemaRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemasRelatedByCreatedBy = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemasRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByCreatedByJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_BY, $this->getId());

				$this->collSchemasRelatedByCreatedBy = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaRelatedByCreatedByCriteria) || !$this->lastSchemaRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemasRelatedByCreatedBy = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemasRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collSchemasRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemasRelatedByUpdatedBy()
	{
		if ($this->collSchemasRelatedByUpdatedBy === null) {
			$this->collSchemasRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemasRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collSchemasRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_BY, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				$this->collSchemasRelatedByUpdatedBy = SchemaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPeer::UPDATED_BY, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaRelatedByUpdatedByCriteria) || !$this->lastSchemaRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collSchemasRelatedByUpdatedBy = SchemaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaRelatedByUpdatedByCriteria = $criteria;
		return $this->collSchemasRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related SchemasRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemasRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPeer::UPDATED_BY, $this->getId());

		return SchemaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Schema object to this object
	 * through the Schema foreign key attribute
	 *
	 * @param      Schema $l Schema
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaRelatedByUpdatedBy(Schema $l)
	{
		$this->collSchemasRelatedByUpdatedBy[] = $l;
		$l->setUsersRelatedByUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByUpdatedByJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_BY, $this->getId());

				$this->collSchemasRelatedByUpdatedBy = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastSchemaRelatedByUpdatedByCriteria) || !$this->lastSchemaRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collSchemasRelatedByUpdatedBy = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByUpdatedByCriteria = $criteria;

		return $this->collSchemasRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByUpdatedByJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_BY, $this->getId());

				$this->collSchemasRelatedByUpdatedBy = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastSchemaRelatedByUpdatedByCriteria) || !$this->lastSchemaRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collSchemasRelatedByUpdatedBy = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByUpdatedByCriteria = $criteria;

		return $this->collSchemasRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_BY, $this->getId());

				$this->collSchemasRelatedByUpdatedBy = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastSchemaRelatedByUpdatedByCriteria) || !$this->lastSchemaRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collSchemasRelatedByUpdatedBy = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByUpdatedByCriteria = $criteria;

		return $this->collSchemasRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByUpdatedByJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_BY, $this->getId());

				$this->collSchemasRelatedByUpdatedBy = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastSchemaRelatedByUpdatedByCriteria) || !$this->lastSchemaRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collSchemasRelatedByUpdatedBy = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByUpdatedByCriteria = $criteria;

		return $this->collSchemasRelatedByUpdatedBy;
	}

	/**
	 * Temporary storage of collSchemasRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemasRelatedByDeletedBy()
	{
		if ($this->collSchemasRelatedByDeletedBy === null) {
			$this->collSchemasRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByDeletedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemasRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collSchemasRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPeer::DELETED_BY, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				$this->collSchemasRelatedByDeletedBy = SchemaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPeer::DELETED_BY, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaRelatedByDeletedByCriteria) || !$this->lastSchemaRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collSchemasRelatedByDeletedBy = SchemaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaRelatedByDeletedByCriteria = $criteria;
		return $this->collSchemasRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related SchemasRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemasRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPeer::DELETED_BY, $this->getId());

		return SchemaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Schema object to this object
	 * through the Schema foreign key attribute
	 *
	 * @param      Schema $l Schema
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaRelatedByDeletedBy(Schema $l)
	{
		$this->collSchemasRelatedByDeletedBy[] = $l;
		$l->setUsersRelatedByDeletedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByDeletedByJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPeer::DELETED_BY, $this->getId());

				$this->collSchemasRelatedByDeletedBy = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastSchemaRelatedByDeletedByCriteria) || !$this->lastSchemaRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collSchemasRelatedByDeletedBy = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByDeletedByCriteria = $criteria;

		return $this->collSchemasRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByDeletedByJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPeer::DELETED_BY, $this->getId());

				$this->collSchemasRelatedByDeletedBy = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastSchemaRelatedByDeletedByCriteria) || !$this->lastSchemaRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collSchemasRelatedByDeletedBy = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByDeletedByCriteria = $criteria;

		return $this->collSchemasRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByDeletedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPeer::DELETED_BY, $this->getId());

				$this->collSchemasRelatedByDeletedBy = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastSchemaRelatedByDeletedByCriteria) || !$this->lastSchemaRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collSchemasRelatedByDeletedBy = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByDeletedByCriteria = $criteria;

		return $this->collSchemasRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemasRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemasRelatedByDeletedByJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemasRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPeer::DELETED_BY, $this->getId());

				$this->collSchemasRelatedByDeletedBy = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastSchemaRelatedByDeletedByCriteria) || !$this->lastSchemaRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collSchemasRelatedByDeletedBy = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByDeletedByCriteria = $criteria;

		return $this->collSchemasRelatedByDeletedBy;
	}

	/**
	 * Temporary storage of collSchemaPropertysRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertysRelatedByCreatedUserId()
	{
		if ($this->collSchemaPropertysRelatedByCreatedUserId === null) {
			$this->collSchemaPropertysRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByCreatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertysRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collSchemaPropertysRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related SchemaPropertysRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertysRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

		return SchemaPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaProperty object to this object
	 * through the SchemaProperty foreign key attribute
	 *
	 * @param      SchemaProperty $l SchemaProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyRelatedByCreatedUserId(SchemaProperty $l)
	{
		$this->collSchemaPropertysRelatedByCreatedUserId[] = $l;
		$l->setUsersRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByCreatedUserIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByCreatedUserIdJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collSchemaPropertysRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertysRelatedByUpdatedUserId()
	{
		if ($this->collSchemaPropertysRelatedByUpdatedUserId === null) {
			$this->collSchemaPropertysRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByUpdatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertysRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collSchemaPropertysRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related SchemaPropertysRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertysRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

		return SchemaPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaProperty object to this object
	 * through the SchemaProperty foreign key attribute
	 *
	 * @param      SchemaProperty $l SchemaProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyRelatedByUpdatedUserId(SchemaProperty $l)
	{
		$this->collSchemaPropertysRelatedByUpdatedUserId[] = $l;
		$l->setUsersRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByUpdatedUserIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByUpdatedUserIdJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collSchemaPropertysRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertysRelatedByCreatedBy()
	{
		if ($this->collSchemaPropertysRelatedByCreatedBy === null) {
			$this->collSchemaPropertysRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertysRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyPeer::CREATED_BY, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				$this->collSchemaPropertysRelatedByCreatedBy = SchemaPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyPeer::CREATED_BY, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collSchemaPropertysRelatedByCreatedBy = SchemaPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyRelatedByCreatedByCriteria = $criteria;
		return $this->collSchemaPropertysRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related SchemaPropertysRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertysRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyPeer::CREATED_BY, $this->getId());

		return SchemaPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaProperty object to this object
	 * through the SchemaProperty foreign key attribute
	 *
	 * @param      SchemaProperty $l SchemaProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyRelatedByCreatedBy(SchemaProperty $l)
	{
		$this->collSchemaPropertysRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByCreatedByJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertysRelatedByCreatedBy = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByCreatedBy = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByCreatedByJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertysRelatedByCreatedBy = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByCreatedBy = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByCreatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertysRelatedByCreatedBy = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByCreatedBy = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collSchemaPropertysRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertysRelatedByUpdatedBy()
	{
		if ($this->collSchemaPropertysRelatedByUpdatedBy === null) {
			$this->collSchemaPropertysRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertysRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPropertyPeer::UPDATED_BY, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				$this->collSchemaPropertysRelatedByUpdatedBy = SchemaPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyPeer::UPDATED_BY, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyRelatedByUpdatedByCriteria) || !$this->lastSchemaPropertyRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collSchemaPropertysRelatedByUpdatedBy = SchemaPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyRelatedByUpdatedByCriteria = $criteria;
		return $this->collSchemaPropertysRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related SchemaPropertysRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertysRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyPeer::UPDATED_BY, $this->getId());

		return SchemaPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaProperty object to this object
	 * through the SchemaProperty foreign key attribute
	 *
	 * @param      SchemaProperty $l SchemaProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyRelatedByUpdatedBy(SchemaProperty $l)
	{
		$this->collSchemaPropertysRelatedByUpdatedBy[] = $l;
		$l->setUsersRelatedByUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByUpdatedByJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPropertyPeer::UPDATED_BY, $this->getId());

				$this->collSchemaPropertysRelatedByUpdatedBy = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByUpdatedByCriteria) || !$this->lastSchemaPropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByUpdatedBy = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByUpdatedByJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPropertyPeer::UPDATED_BY, $this->getId());

				$this->collSchemaPropertysRelatedByUpdatedBy = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByUpdatedByCriteria) || !$this->lastSchemaPropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByUpdatedBy = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPropertyPeer::UPDATED_BY, $this->getId());

				$this->collSchemaPropertysRelatedByUpdatedBy = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByUpdatedByCriteria) || !$this->lastSchemaPropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByUpdatedBy = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByUpdatedBy;
	}

	/**
	 * Temporary storage of collSchemaPropertysRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertysRelatedByDeletedBy()
	{
		if ($this->collSchemaPropertysRelatedByDeletedBy === null) {
			$this->collSchemaPropertysRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByDeletedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertysRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPropertyPeer::DELETED_BY, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				$this->collSchemaPropertysRelatedByDeletedBy = SchemaPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyPeer::DELETED_BY, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyRelatedByDeletedByCriteria) || !$this->lastSchemaPropertyRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collSchemaPropertysRelatedByDeletedBy = SchemaPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyRelatedByDeletedByCriteria = $criteria;
		return $this->collSchemaPropertysRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related SchemaPropertysRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertysRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyPeer::DELETED_BY, $this->getId());

		return SchemaPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaProperty object to this object
	 * through the SchemaProperty foreign key attribute
	 *
	 * @param      SchemaProperty $l SchemaProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyRelatedByDeletedBy(SchemaProperty $l)
	{
		$this->collSchemaPropertysRelatedByDeletedBy[] = $l;
		$l->setUsersRelatedByDeletedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByDeletedByJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPropertyPeer::DELETED_BY, $this->getId());

				$this->collSchemaPropertysRelatedByDeletedBy = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByDeletedByCriteria) || !$this->lastSchemaPropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByDeletedBy = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByDeletedByJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPropertyPeer::DELETED_BY, $this->getId());

				$this->collSchemaPropertysRelatedByDeletedBy = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByDeletedByCriteria) || !$this->lastSchemaPropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByDeletedBy = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertysRelatedByDeletedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPropertyPeer::DELETED_BY, $this->getId());

				$this->collSchemaPropertysRelatedByDeletedBy = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByDeletedByCriteria) || !$this->lastSchemaPropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByDeletedBy = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByDeletedBy;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementsRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementsRelatedByCreatedUserId()
	{
		if ($this->collSchemaPropertyElementsRelatedByCreatedUserId === null) {
			$this->collSchemaPropertyElementsRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementsRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collSchemaPropertyElementsRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related SchemaPropertyElementsRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementsRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

		return SchemaPropertyElementPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyElement object to this object
	 * through the SchemaPropertyElement foreign key attribute
	 *
	 * @param      SchemaPropertyElement $l SchemaPropertyElement
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyElementRelatedByCreatedUserId(SchemaPropertyElement $l)
	{
		$this->collSchemaPropertyElementsRelatedByCreatedUserId[] = $l;
		$l->setUsersRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByCreatedUserIdJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByCreatedUserIdJoinProfileProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByCreatedUserIdJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementsRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementsRelatedByUpdatedUserId()
	{
		if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId === null) {
			$this->collSchemaPropertyElementsRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collSchemaPropertyElementsRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related SchemaPropertyElementsRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementsRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

		return SchemaPropertyElementPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyElement object to this object
	 * through the SchemaPropertyElement foreign key attribute
	 *
	 * @param      SchemaPropertyElement $l SchemaPropertyElement
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyElementRelatedByUpdatedUserId(SchemaPropertyElement $l)
	{
		$this->collSchemaPropertyElementsRelatedByUpdatedUserId[] = $l;
		$l->setUsersRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedUserIdJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedUserIdJoinProfileProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedUserIdJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementsRelatedByDeletedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementsRelatedByDeletedUserId()
	{
		if ($this->collSchemaPropertyElementsRelatedByDeletedUserId === null) {
			$this->collSchemaPropertyElementsRelatedByDeletedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByDeletedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementsRelatedByDeletedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementsRelatedByDeletedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::DELETED_USER_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementsRelatedByDeletedUserId = SchemaPropertyElementPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementPeer::DELETED_USER_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementsRelatedByDeletedUserId = SchemaPropertyElementPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria = $criteria;
		return $this->collSchemaPropertyElementsRelatedByDeletedUserId;
	}

	/**
	 * Returns the number of related SchemaPropertyElementsRelatedByDeletedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementsRelatedByDeletedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyElementPeer::DELETED_USER_ID, $this->getId());

		return SchemaPropertyElementPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyElement object to this object
	 * through the SchemaPropertyElement foreign key attribute
	 *
	 * @param      SchemaPropertyElement $l SchemaPropertyElement
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyElementRelatedByDeletedUserId(SchemaPropertyElement $l)
	{
		$this->collSchemaPropertyElementsRelatedByDeletedUserId[] = $l;
		$l->setUsersRelatedByDeletedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByDeletedUserIdJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByDeletedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::DELETED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByDeletedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByDeletedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByDeletedUserIdJoinProfileProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByDeletedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::DELETED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByDeletedUserId = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByDeletedUserId = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByDeletedUserIdJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByDeletedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::DELETED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByDeletedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByDeletedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByDeletedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByDeletedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::DELETED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByDeletedUserId = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByDeletedUserId = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByDeletedUserId;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementsRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementsRelatedByCreatedBy()
	{
		if ($this->collSchemaPropertyElementsRelatedByCreatedBy === null) {
			$this->collSchemaPropertyElementsRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementsRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementsRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_BY, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementsRelatedByCreatedBy = SchemaPropertyElementPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementPeer::CREATED_BY, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementsRelatedByCreatedBy = SchemaPropertyElementPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedByCriteria = $criteria;
		return $this->collSchemaPropertyElementsRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related SchemaPropertyElementsRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementsRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyElementPeer::CREATED_BY, $this->getId());

		return SchemaPropertyElementPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyElement object to this object
	 * through the SchemaPropertyElement foreign key attribute
	 *
	 * @param      SchemaPropertyElement $l SchemaPropertyElement
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyElementRelatedByCreatedBy(SchemaPropertyElement $l)
	{
		$this->collSchemaPropertyElementsRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByCreatedByJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertyElementsRelatedByCreatedBy = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByCreatedBy = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByCreatedByJoinProfileProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertyElementsRelatedByCreatedBy = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByCreatedBy = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByCreatedByJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertyElementsRelatedByCreatedBy = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByCreatedBy = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByCreatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertyElementsRelatedByCreatedBy = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByCreatedBy = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementsRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementsRelatedByUpdatedBy()
	{
		if ($this->collSchemaPropertyElementsRelatedByUpdatedBy === null) {
			$this->collSchemaPropertyElementsRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_BY, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementsRelatedByUpdatedBy = SchemaPropertyElementPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementPeer::UPDATED_BY, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedByCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementsRelatedByUpdatedBy = SchemaPropertyElementPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedByCriteria = $criteria;
		return $this->collSchemaPropertyElementsRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related SchemaPropertyElementsRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementsRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyElementPeer::UPDATED_BY, $this->getId());

		return SchemaPropertyElementPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyElement object to this object
	 * through the SchemaPropertyElement foreign key attribute
	 *
	 * @param      SchemaPropertyElement $l SchemaPropertyElement
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyElementRelatedByUpdatedBy(SchemaPropertyElement $l)
	{
		$this->collSchemaPropertyElementsRelatedByUpdatedBy[] = $l;
		$l->setUsersRelatedByUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedByJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_BY, $this->getId());

				$this->collSchemaPropertyElementsRelatedByUpdatedBy = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedByCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByUpdatedBy = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedByJoinProfileProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_BY, $this->getId());

				$this->collSchemaPropertyElementsRelatedByUpdatedBy = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedByCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByUpdatedBy = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedByJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_BY, $this->getId());

				$this->collSchemaPropertyElementsRelatedByUpdatedBy = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedByCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByUpdatedBy = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByUpdatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_BY, $this->getId());

				$this->collSchemaPropertyElementsRelatedByUpdatedBy = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedByCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByUpdatedBy = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByUpdatedBy;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementsRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementsRelatedByDeletedBy()
	{
		if ($this->collSchemaPropertyElementsRelatedByDeletedBy === null) {
			$this->collSchemaPropertyElementsRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByDeletedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementsRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementsRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::DELETED_BY, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementsRelatedByDeletedBy = SchemaPropertyElementPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementPeer::DELETED_BY, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementRelatedByDeletedByCriteria) || !$this->lastSchemaPropertyElementRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementsRelatedByDeletedBy = SchemaPropertyElementPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementRelatedByDeletedByCriteria = $criteria;
		return $this->collSchemaPropertyElementsRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related SchemaPropertyElementsRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementsRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyElementPeer::DELETED_BY, $this->getId());

		return SchemaPropertyElementPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyElement object to this object
	 * through the SchemaPropertyElement foreign key attribute
	 *
	 * @param      SchemaPropertyElement $l SchemaPropertyElement
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyElementRelatedByDeletedBy(SchemaPropertyElement $l)
	{
		$this->collSchemaPropertyElementsRelatedByDeletedBy[] = $l;
		$l->setUsersRelatedByDeletedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByDeletedByJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::DELETED_BY, $this->getId());

				$this->collSchemaPropertyElementsRelatedByDeletedBy = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByDeletedByCriteria) || !$this->lastSchemaPropertyElementRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByDeletedBy = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByDeletedByCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByDeletedByJoinProfileProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::DELETED_BY, $this->getId());

				$this->collSchemaPropertyElementsRelatedByDeletedBy = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByDeletedByCriteria) || !$this->lastSchemaPropertyElementRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByDeletedBy = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByDeletedByCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByDeletedByJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::DELETED_BY, $this->getId());

				$this->collSchemaPropertyElementsRelatedByDeletedBy = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByDeletedByCriteria) || !$this->lastSchemaPropertyElementRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByDeletedBy = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByDeletedByCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementsRelatedByDeletedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementsRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByDeletedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::DELETED_BY, $this->getId());

				$this->collSchemaPropertyElementsRelatedByDeletedBy = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByDeletedByCriteria) || !$this->lastSchemaPropertyElementRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByDeletedBy = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByDeletedByCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByDeletedBy;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementHistorysRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementHistorysRelatedByCreatedUserId()
	{
		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId === null) {
			$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collSchemaPropertyElementHistorysRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related SchemaPropertyElementHistorysRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementHistorysRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

		return SchemaPropertyElementHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyElementHistory object to this object
	 * through the SchemaPropertyElementHistory foreign key attribute
	 *
	 * @param      SchemaPropertyElementHistory $l SchemaPropertyElementHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyElementHistoryRelatedByCreatedUserId(SchemaPropertyElementHistory $l)
	{
		$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId[] = $l;
		$l->setUsersRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedUserIdJoinSchemaPropertyElement($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedUserIdJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedUserIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedUserIdJoinProfileProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedUserIdJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedUserIdJoinFileImportHistory($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedUserId = SchemaPropertyElementHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementHistorysRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementHistorysRelatedByCreatedBy()
	{
		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedBy === null) {
			$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria = $criteria;
		return $this->collSchemaPropertyElementHistorysRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related SchemaPropertyElementHistorysRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementHistorysRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

		return SchemaPropertyElementHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyElementHistory object to this object
	 * through the SchemaPropertyElementHistory foreign key attribute
	 *
	 * @param      SchemaPropertyElementHistory $l SchemaPropertyElementHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyElementHistoryRelatedByCreatedBy(SchemaPropertyElementHistory $l)
	{
		$this->collSchemaPropertyElementHistorysRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedByJoinSchemaPropertyElement($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedByJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedByJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedByJoinProfileProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedByJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaPropertyElementHistorysRelatedByCreatedByJoinFileImportHistory($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByCreatedBy = SchemaPropertyElementHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByCreatedUserId()
	{
		if ($this->collVocabularysRelatedByCreatedUserId === null) {
			$this->collVocabularysRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByCreatedUserIdCriteria) || !$this->lastVocabularyRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collVocabularysRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related VocabularysRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

		return VocabularyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Vocabulary object to this object
	 * through the Vocabulary foreign key attribute
	 *
	 * @param      Vocabulary $l Vocabulary
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabularyRelatedByCreatedUserId(Vocabulary $l)
	{
		$this->collVocabularysRelatedByCreatedUserId[] = $l;
		$l->setUsersRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByCreatedUserIdJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByCreatedUserIdCriteria) || !$this->lastVocabularyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByCreatedUserIdJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByCreatedUserIdCriteria) || !$this->lastVocabularyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByCreatedUserIdCriteria) || !$this->lastVocabularyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByCreatedUserIdJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByCreatedUserIdCriteria) || !$this->lastVocabularyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByUpdatedUserId()
	{
		if ($this->collVocabularysRelatedByUpdatedUserId === null) {
			$this->collVocabularysRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collVocabularysRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related VocabularysRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

		return VocabularyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Vocabulary object to this object
	 * through the Vocabulary foreign key attribute
	 *
	 * @param      Vocabulary $l Vocabulary
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabularyRelatedByUpdatedUserId(Vocabulary $l)
	{
		$this->collVocabularysRelatedByUpdatedUserId[] = $l;
		$l->setUsersRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByUpdatedUserIdJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByUpdatedUserIdJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByUpdatedUserIdJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByDeletedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByDeletedUserId()
	{
		if ($this->collVocabularysRelatedByDeletedUserId === null) {
			$this->collVocabularysRelatedByDeletedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByDeletedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByDeletedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByDeletedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::DELETED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByDeletedUserId = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::DELETED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByDeletedUserIdCriteria) || !$this->lastVocabularyRelatedByDeletedUserIdCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByDeletedUserId = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByDeletedUserIdCriteria = $criteria;
		return $this->collVocabularysRelatedByDeletedUserId;
	}

	/**
	 * Returns the number of related VocabularysRelatedByDeletedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByDeletedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyPeer::DELETED_USER_ID, $this->getId());

		return VocabularyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Vocabulary object to this object
	 * through the Vocabulary foreign key attribute
	 *
	 * @param      Vocabulary $l Vocabulary
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabularyRelatedByDeletedUserId(Vocabulary $l)
	{
		$this->collVocabularysRelatedByDeletedUserId[] = $l;
		$l->setUsersRelatedByDeletedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByDeletedUserIdJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByDeletedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::DELETED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByDeletedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByDeletedUserIdCriteria) || !$this->lastVocabularyRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByDeletedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByDeletedUserIdJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByDeletedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::DELETED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByDeletedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByDeletedUserIdCriteria) || !$this->lastVocabularyRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByDeletedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByDeletedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByDeletedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::DELETED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByDeletedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByDeletedUserIdCriteria) || !$this->lastVocabularyRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByDeletedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByDeletedUserIdJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByDeletedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::DELETED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByDeletedUserId = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByDeletedUserIdCriteria) || !$this->lastVocabularyRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByDeletedUserId = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByDeletedUserId;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByChildUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByChildUpdatedUserId()
	{
		if ($this->collVocabularysRelatedByChildUpdatedUserId === null) {
			$this->collVocabularysRelatedByChildUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByChildUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByChildUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByChildUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByChildUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria = $criteria;
		return $this->collVocabularysRelatedByChildUpdatedUserId;
	}

	/**
	 * Returns the number of related VocabularysRelatedByChildUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByChildUpdatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

		return VocabularyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Vocabulary object to this object
	 * through the Vocabulary foreign key attribute
	 *
	 * @param      Vocabulary $l Vocabulary
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabularyRelatedByChildUpdatedUserId(Vocabulary $l)
	{
		$this->collVocabularysRelatedByChildUpdatedUserId[] = $l;
		$l->setUsersRelatedByChildUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByChildUpdatedUserIdJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByChildUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByChildUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByChildUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByChildUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByChildUpdatedUserIdJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByChildUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByChildUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByChildUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByChildUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByChildUpdatedUserIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByChildUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByChildUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByChildUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByChildUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByChildUpdatedUserIdJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByChildUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByChildUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByChildUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByChildUpdatedUserId;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByCreatedBy()
	{
		if ($this->collVocabularysRelatedByCreatedBy === null) {
			$this->collVocabularysRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByCreatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_BY, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByCreatedBy = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::CREATED_BY, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByCreatedByCriteria) || !$this->lastVocabularyRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByCreatedBy = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByCreatedByCriteria = $criteria;
		return $this->collVocabularysRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related VocabularysRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyPeer::CREATED_BY, $this->getId());

		return VocabularyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Vocabulary object to this object
	 * through the Vocabulary foreign key attribute
	 *
	 * @param      Vocabulary $l Vocabulary
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabularyRelatedByCreatedBy(Vocabulary $l)
	{
		$this->collVocabularysRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByCreatedByJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByCreatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_BY, $this->getId());

				$this->collVocabularysRelatedByCreatedBy = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByCreatedByCriteria) || !$this->lastVocabularyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByCreatedBy = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByCreatedByCriteria = $criteria;

		return $this->collVocabularysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByCreatedByJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByCreatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_BY, $this->getId());

				$this->collVocabularysRelatedByCreatedBy = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByCreatedByCriteria) || !$this->lastVocabularyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByCreatedBy = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByCreatedByCriteria = $criteria;

		return $this->collVocabularysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByCreatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByCreatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_BY, $this->getId());

				$this->collVocabularysRelatedByCreatedBy = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByCreatedByCriteria) || !$this->lastVocabularyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByCreatedBy = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByCreatedByCriteria = $criteria;

		return $this->collVocabularysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByCreatedByJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByCreatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_BY, $this->getId());

				$this->collVocabularysRelatedByCreatedBy = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByCreatedByCriteria) || !$this->lastVocabularyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByCreatedBy = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByCreatedByCriteria = $criteria;

		return $this->collVocabularysRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByUpdatedBy()
	{
		if ($this->collVocabularysRelatedByUpdatedBy === null) {
			$this->collVocabularysRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_BY, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByUpdatedBy = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::UPDATED_BY, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByUpdatedByCriteria) || !$this->lastVocabularyRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByUpdatedBy = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByUpdatedByCriteria = $criteria;
		return $this->collVocabularysRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related VocabularysRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyPeer::UPDATED_BY, $this->getId());

		return VocabularyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Vocabulary object to this object
	 * through the Vocabulary foreign key attribute
	 *
	 * @param      Vocabulary $l Vocabulary
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabularyRelatedByUpdatedBy(Vocabulary $l)
	{
		$this->collVocabularysRelatedByUpdatedBy[] = $l;
		$l->setUsersRelatedByUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByUpdatedByJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_BY, $this->getId());

				$this->collVocabularysRelatedByUpdatedBy = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByUpdatedByCriteria) || !$this->lastVocabularyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByUpdatedBy = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByUpdatedByCriteria = $criteria;

		return $this->collVocabularysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByUpdatedByJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_BY, $this->getId());

				$this->collVocabularysRelatedByUpdatedBy = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByUpdatedByCriteria) || !$this->lastVocabularyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByUpdatedBy = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByUpdatedByCriteria = $criteria;

		return $this->collVocabularysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_BY, $this->getId());

				$this->collVocabularysRelatedByUpdatedBy = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByUpdatedByCriteria) || !$this->lastVocabularyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByUpdatedBy = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByUpdatedByCriteria = $criteria;

		return $this->collVocabularysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByUpdatedByJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_BY, $this->getId());

				$this->collVocabularysRelatedByUpdatedBy = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByUpdatedByCriteria) || !$this->lastVocabularyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByUpdatedBy = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByUpdatedByCriteria = $criteria;

		return $this->collVocabularysRelatedByUpdatedBy;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByDeletedBy()
	{
		if ($this->collVocabularysRelatedByDeletedBy === null) {
			$this->collVocabularysRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByDeletedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByDeletedBy = array();
			} else {

				$criteria->add(VocabularyPeer::DELETED_BY, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByDeletedBy = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::DELETED_BY, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByDeletedByCriteria) || !$this->lastVocabularyRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByDeletedBy = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByDeletedByCriteria = $criteria;
		return $this->collVocabularysRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related VocabularysRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyPeer::DELETED_BY, $this->getId());

		return VocabularyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Vocabulary object to this object
	 * through the Vocabulary foreign key attribute
	 *
	 * @param      Vocabulary $l Vocabulary
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabularyRelatedByDeletedBy(Vocabulary $l)
	{
		$this->collVocabularysRelatedByDeletedBy[] = $l;
		$l->setUsersRelatedByDeletedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByDeletedByJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByDeletedBy = array();
			} else {

				$criteria->add(VocabularyPeer::DELETED_BY, $this->getId());

				$this->collVocabularysRelatedByDeletedBy = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByDeletedByCriteria) || !$this->lastVocabularyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByDeletedBy = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByDeletedByCriteria = $criteria;

		return $this->collVocabularysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByDeletedByJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByDeletedBy = array();
			} else {

				$criteria->add(VocabularyPeer::DELETED_BY, $this->getId());

				$this->collVocabularysRelatedByDeletedBy = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByDeletedByCriteria) || !$this->lastVocabularyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByDeletedBy = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByDeletedByCriteria = $criteria;

		return $this->collVocabularysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByDeletedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByDeletedBy = array();
			} else {

				$criteria->add(VocabularyPeer::DELETED_BY, $this->getId());

				$this->collVocabularysRelatedByDeletedBy = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByDeletedByCriteria) || !$this->lastVocabularyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByDeletedBy = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByDeletedByCriteria = $criteria;

		return $this->collVocabularysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByDeletedByJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByDeletedBy = array();
			} else {

				$criteria->add(VocabularyPeer::DELETED_BY, $this->getId());

				$this->collVocabularysRelatedByDeletedBy = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByDeletedByCriteria) || !$this->lastVocabularyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByDeletedBy = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByDeletedByCriteria = $criteria;

		return $this->collVocabularysRelatedByDeletedBy;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByChildUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByChildUpdatedBy()
	{
		if ($this->collVocabularysRelatedByChildUpdatedBy === null) {
			$this->collVocabularysRelatedByChildUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByChildUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByChildUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByChildUpdatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_BY, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByChildUpdatedBy = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::CHILD_UPDATED_BY, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByChildUpdatedByCriteria) || !$this->lastVocabularyRelatedByChildUpdatedByCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByChildUpdatedBy = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedByCriteria = $criteria;
		return $this->collVocabularysRelatedByChildUpdatedBy;
	}

	/**
	 * Returns the number of related VocabularysRelatedByChildUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByChildUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyPeer::CHILD_UPDATED_BY, $this->getId());

		return VocabularyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Vocabulary object to this object
	 * through the Vocabulary foreign key attribute
	 *
	 * @param      Vocabulary $l Vocabulary
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabularyRelatedByChildUpdatedBy(Vocabulary $l)
	{
		$this->collVocabularysRelatedByChildUpdatedBy[] = $l;
		$l->setUsersRelatedByChildUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByChildUpdatedByJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByChildUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByChildUpdatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_BY, $this->getId());

				$this->collVocabularysRelatedByChildUpdatedBy = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CHILD_UPDATED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByChildUpdatedByCriteria) || !$this->lastVocabularyRelatedByChildUpdatedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByChildUpdatedBy = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedByCriteria = $criteria;

		return $this->collVocabularysRelatedByChildUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByChildUpdatedByJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByChildUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByChildUpdatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_BY, $this->getId());

				$this->collVocabularysRelatedByChildUpdatedBy = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CHILD_UPDATED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByChildUpdatedByCriteria) || !$this->lastVocabularyRelatedByChildUpdatedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByChildUpdatedBy = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedByCriteria = $criteria;

		return $this->collVocabularysRelatedByChildUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByChildUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByChildUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByChildUpdatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_BY, $this->getId());

				$this->collVocabularysRelatedByChildUpdatedBy = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CHILD_UPDATED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByChildUpdatedByCriteria) || !$this->lastVocabularyRelatedByChildUpdatedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByChildUpdatedBy = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedByCriteria = $criteria;

		return $this->collVocabularysRelatedByChildUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularysRelatedByChildUpdatedByJoinProfile($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularysRelatedByChildUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByChildUpdatedBy = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_BY, $this->getId());

				$this->collVocabularysRelatedByChildUpdatedBy = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CHILD_UPDATED_BY, $this->getId());

			if (!isset($this->lastVocabularyRelatedByChildUpdatedByCriteria) || !$this->lastVocabularyRelatedByChildUpdatedByCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByChildUpdatedBy = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedByCriteria = $criteria;

		return $this->collVocabularysRelatedByChildUpdatedBy;
	}

	/**
	 * Temporary storage of collVocabularyHasUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularyHasUsers()
	{
		if ($this->collVocabularyHasUsers === null) {
			$this->collVocabularyHasUsers = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related VocabularyHasUsers from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularyHasUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasUsers === null) {
			if ($this->isNew()) {
			   $this->collVocabularyHasUsers = array();
			} else {

				$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

				VocabularyHasUserPeer::addSelectColumns($criteria);
				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

				VocabularyHasUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyHasUserCriteria) || !$this->lastVocabularyHasUserCriteria->equals($criteria)) {
					$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyHasUserCriteria = $criteria;
		return $this->collVocabularyHasUsers;
	}

	/**
	 * Returns the number of related VocabularyHasUsers.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularyHasUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

		return VocabularyHasUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a VocabularyHasUser object to this object
	 * through the VocabularyHasUser foreign key attribute
	 *
	 * @param      VocabularyHasUser $l VocabularyHasUser
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabularyHasUser(VocabularyHasUser $l)
	{
		$this->collVocabularyHasUsers[] = $l;
		$l->setUsers($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularyHasUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularyHasUsersJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasUsers === null) {
			if ($this->isNew()) {
				$this->collVocabularyHasUsers = array();
			} else {

				$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

			if (!isset($this->lastVocabularyHasUserCriteria) || !$this->lastVocabularyHasUserCriteria->equals($criteria)) {
				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastVocabularyHasUserCriteria = $criteria;

		return $this->collVocabularyHasUsers;
	}

	/**
	 * Temporary storage of collVocabularyHasVersionsRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularyHasVersionsRelatedByCreatedUserId()
	{
		if ($this->collVocabularyHasVersionsRelatedByCreatedUserId === null) {
			$this->collVocabularyHasVersionsRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related VocabularyHasVersionsRelatedByCreatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularyHasVersionsRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasVersionsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collVocabularyHasVersionsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(VocabularyHasVersionPeer::CREATED_USER_ID, $this->getId());

				VocabularyHasVersionPeer::addSelectColumns($criteria);
				$this->collVocabularyHasVersionsRelatedByCreatedUserId = VocabularyHasVersionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyHasVersionPeer::CREATED_USER_ID, $this->getId());

				VocabularyHasVersionPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyHasVersionRelatedByCreatedUserIdCriteria) || !$this->lastVocabularyHasVersionRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collVocabularyHasVersionsRelatedByCreatedUserId = VocabularyHasVersionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyHasVersionRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collVocabularyHasVersionsRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related VocabularyHasVersionsRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularyHasVersionsRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyHasVersionPeer::CREATED_USER_ID, $this->getId());

		return VocabularyHasVersionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a VocabularyHasVersion object to this object
	 * through the VocabularyHasVersion foreign key attribute
	 *
	 * @param      VocabularyHasVersion $l VocabularyHasVersion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabularyHasVersionRelatedByCreatedUserId(VocabularyHasVersion $l)
	{
		$this->collVocabularyHasVersionsRelatedByCreatedUserId[] = $l;
		$l->setUsersRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularyHasVersionsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularyHasVersionsRelatedByCreatedUserIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasVersionsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularyHasVersionsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(VocabularyHasVersionPeer::CREATED_USER_ID, $this->getId());

				$this->collVocabularyHasVersionsRelatedByCreatedUserId = VocabularyHasVersionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyHasVersionPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyHasVersionRelatedByCreatedUserIdCriteria) || !$this->lastVocabularyHasVersionRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularyHasVersionsRelatedByCreatedUserId = VocabularyHasVersionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastVocabularyHasVersionRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collVocabularyHasVersionsRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collVocabularyHasVersionsRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularyHasVersionsRelatedByCreatedBy()
	{
		if ($this->collVocabularyHasVersionsRelatedByCreatedBy === null) {
			$this->collVocabularyHasVersionsRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related VocabularyHasVersionsRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularyHasVersionsRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasVersionsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collVocabularyHasVersionsRelatedByCreatedBy = array();
			} else {

				$criteria->add(VocabularyHasVersionPeer::CREATED_BY, $this->getId());

				VocabularyHasVersionPeer::addSelectColumns($criteria);
				$this->collVocabularyHasVersionsRelatedByCreatedBy = VocabularyHasVersionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyHasVersionPeer::CREATED_BY, $this->getId());

				VocabularyHasVersionPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyHasVersionRelatedByCreatedByCriteria) || !$this->lastVocabularyHasVersionRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collVocabularyHasVersionsRelatedByCreatedBy = VocabularyHasVersionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyHasVersionRelatedByCreatedByCriteria = $criteria;
		return $this->collVocabularyHasVersionsRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related VocabularyHasVersionsRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularyHasVersionsRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyHasVersionPeer::CREATED_BY, $this->getId());

		return VocabularyHasVersionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a VocabularyHasVersion object to this object
	 * through the VocabularyHasVersion foreign key attribute
	 *
	 * @param      VocabularyHasVersion $l VocabularyHasVersion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabularyHasVersionRelatedByCreatedBy(VocabularyHasVersion $l)
	{
		$this->collVocabularyHasVersionsRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related VocabularyHasVersionsRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getVocabularyHasVersionsRelatedByCreatedByJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasVersionsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collVocabularyHasVersionsRelatedByCreatedBy = array();
			} else {

				$criteria->add(VocabularyHasVersionPeer::CREATED_BY, $this->getId());

				$this->collVocabularyHasVersionsRelatedByCreatedBy = VocabularyHasVersionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyHasVersionPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastVocabularyHasVersionRelatedByCreatedByCriteria) || !$this->lastVocabularyHasVersionRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collVocabularyHasVersionsRelatedByCreatedBy = VocabularyHasVersionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastVocabularyHasVersionRelatedByCreatedByCriteria = $criteria;

		return $this->collVocabularyHasVersionsRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collRoleUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRoleUsers()
	{
		if ($this->collRoleUsers === null) {
			$this->collRoleUsers = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related RoleUsers from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRoleUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRoleUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleUsers === null) {
			if ($this->isNew()) {
			   $this->collRoleUsers = array();
			} else {

				$criteria->add(RoleUserPeer::USER_ID, $this->getId());

				RoleUserPeer::addSelectColumns($criteria);
				$this->collRoleUsers = RoleUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RoleUserPeer::USER_ID, $this->getId());

				RoleUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastRoleUserCriteria) || !$this->lastRoleUserCriteria->equals($criteria)) {
					$this->collRoleUsers = RoleUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRoleUserCriteria = $criteria;
		return $this->collRoleUsers;
	}

	/**
	 * Returns the number of related RoleUsers.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRoleUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRoleUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RoleUserPeer::USER_ID, $this->getId());

		return RoleUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RoleUser object to this object
	 * through the RoleUser foreign key attribute
	 *
	 * @param      RoleUser $l RoleUser
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRoleUser(RoleUser $l)
	{
		$this->collRoleUsers[] = $l;
		$l->setUsers($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related RoleUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getRoleUsersJoinRoles($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRoleUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleUsers === null) {
			if ($this->isNew()) {
				$this->collRoleUsers = array();
			} else {

				$criteria->add(RoleUserPeer::USER_ID, $this->getId());

				$this->collRoleUsers = RoleUserPeer::doSelectJoinRoles($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RoleUserPeer::USER_ID, $this->getId());

			if (!isset($this->lastRoleUserCriteria) || !$this->lastRoleUserCriteria->equals($criteria)) {
				$this->collRoleUsers = RoleUserPeer::doSelectJoinRoles($criteria, $con);
			}
		}
		$this->lastRoleUserCriteria = $criteria;

		return $this->collRoleUsers;
	}

	/**
	 * Temporary storage of collSchemaHasUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaHasUsers()
	{
		if ($this->collSchemaHasUsers === null) {
			$this->collSchemaHasUsers = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaHasUsers from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaHasUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaHasUsers === null) {
			if ($this->isNew()) {
			   $this->collSchemaHasUsers = array();
			} else {

				$criteria->add(SchemaHasUserPeer::USER_ID, $this->getId());

				SchemaHasUserPeer::addSelectColumns($criteria);
				$this->collSchemaHasUsers = SchemaHasUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaHasUserPeer::USER_ID, $this->getId());

				SchemaHasUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaHasUserCriteria) || !$this->lastSchemaHasUserCriteria->equals($criteria)) {
					$this->collSchemaHasUsers = SchemaHasUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaHasUserCriteria = $criteria;
		return $this->collSchemaHasUsers;
	}

	/**
	 * Returns the number of related SchemaHasUsers.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaHasUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaHasUserPeer::USER_ID, $this->getId());

		return SchemaHasUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaHasUser object to this object
	 * through the SchemaHasUser foreign key attribute
	 *
	 * @param      SchemaHasUser $l SchemaHasUser
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaHasUser(SchemaHasUser $l)
	{
		$this->collSchemaHasUsers[] = $l;
		$l->setUsers($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaHasUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaHasUsersJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaHasUsers === null) {
			if ($this->isNew()) {
				$this->collSchemaHasUsers = array();
			} else {

				$criteria->add(SchemaHasUserPeer::USER_ID, $this->getId());

				$this->collSchemaHasUsers = SchemaHasUserPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaHasUserPeer::USER_ID, $this->getId());

			if (!isset($this->lastSchemaHasUserCriteria) || !$this->lastSchemaHasUserCriteria->equals($criteria)) {
				$this->collSchemaHasUsers = SchemaHasUserPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaHasUserCriteria = $criteria;

		return $this->collSchemaHasUsers;
	}

	/**
	 * Temporary storage of collSchemaHasVersionsRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaHasVersionsRelatedByCreatedUserId()
	{
		if ($this->collSchemaHasVersionsRelatedByCreatedUserId === null) {
			$this->collSchemaHasVersionsRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaHasVersionsRelatedByCreatedUserId from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaHasVersionsRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaHasVersionsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemaHasVersionsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaHasVersionPeer::CREATED_USER_ID, $this->getId());

				SchemaHasVersionPeer::addSelectColumns($criteria);
				$this->collSchemaHasVersionsRelatedByCreatedUserId = SchemaHasVersionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaHasVersionPeer::CREATED_USER_ID, $this->getId());

				SchemaHasVersionPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaHasVersionRelatedByCreatedUserIdCriteria) || !$this->lastSchemaHasVersionRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collSchemaHasVersionsRelatedByCreatedUserId = SchemaHasVersionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaHasVersionRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collSchemaHasVersionsRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related SchemaHasVersionsRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaHasVersionsRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaHasVersionPeer::CREATED_USER_ID, $this->getId());

		return SchemaHasVersionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaHasVersion object to this object
	 * through the SchemaHasVersion foreign key attribute
	 *
	 * @param      SchemaHasVersion $l SchemaHasVersion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaHasVersionRelatedByCreatedUserId(SchemaHasVersion $l)
	{
		$this->collSchemaHasVersionsRelatedByCreatedUserId[] = $l;
		$l->setUsersRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaHasVersionsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaHasVersionsRelatedByCreatedUserIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaHasVersionsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaHasVersionsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaHasVersionPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaHasVersionsRelatedByCreatedUserId = SchemaHasVersionPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaHasVersionPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaHasVersionRelatedByCreatedUserIdCriteria) || !$this->lastSchemaHasVersionRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaHasVersionsRelatedByCreatedUserId = SchemaHasVersionPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaHasVersionRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaHasVersionsRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collSchemaHasVersionsRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaHasVersionsRelatedByCreatedBy()
	{
		if ($this->collSchemaHasVersionsRelatedByCreatedBy === null) {
			$this->collSchemaHasVersionsRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SchemaHasVersionsRelatedByCreatedBy from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaHasVersionsRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaHasVersionsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collSchemaHasVersionsRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaHasVersionPeer::CREATED_BY, $this->getId());

				SchemaHasVersionPeer::addSelectColumns($criteria);
				$this->collSchemaHasVersionsRelatedByCreatedBy = SchemaHasVersionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaHasVersionPeer::CREATED_BY, $this->getId());

				SchemaHasVersionPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaHasVersionRelatedByCreatedByCriteria) || !$this->lastSchemaHasVersionRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collSchemaHasVersionsRelatedByCreatedBy = SchemaHasVersionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaHasVersionRelatedByCreatedByCriteria = $criteria;
		return $this->collSchemaHasVersionsRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related SchemaHasVersionsRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaHasVersionsRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaHasVersionPeer::CREATED_BY, $this->getId());

		return SchemaHasVersionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaHasVersion object to this object
	 * through the SchemaHasVersion foreign key attribute
	 *
	 * @param      SchemaHasVersion $l SchemaHasVersion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaHasVersionRelatedByCreatedBy(SchemaHasVersion $l)
	{
		$this->collSchemaHasVersionsRelatedByCreatedBy[] = $l;
		$l->setUsersRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users is new, it will return
	 * an empty collection; or if this Users has previously
	 * been saved, it will retrieve related SchemaHasVersionsRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Users.
	 */
	public function getSchemaHasVersionsRelatedByCreatedByJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaHasVersionsRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collSchemaHasVersionsRelatedByCreatedBy = array();
			} else {

				$criteria->add(SchemaHasVersionPeer::CREATED_BY, $this->getId());

				$this->collSchemaHasVersionsRelatedByCreatedBy = SchemaHasVersionPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaHasVersionPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastSchemaHasVersionRelatedByCreatedByCriteria) || !$this->lastSchemaHasVersionRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collSchemaHasVersionsRelatedByCreatedBy = SchemaHasVersionPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaHasVersionRelatedByCreatedByCriteria = $criteria;

		return $this->collSchemaHasVersionsRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collSocialLoginss to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSocialLoginss()
	{
		if ($this->collSocialLoginss === null) {
			$this->collSocialLoginss = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Users has previously
	 * been saved, it will retrieve related SocialLoginss from storage.
	 * If this Users is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSocialLoginss($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSocialLoginsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSocialLoginss === null) {
			if ($this->isNew()) {
			   $this->collSocialLoginss = array();
			} else {

				$criteria->add(SocialLoginsPeer::USER_ID, $this->getId());

				SocialLoginsPeer::addSelectColumns($criteria);
				$this->collSocialLoginss = SocialLoginsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SocialLoginsPeer::USER_ID, $this->getId());

				SocialLoginsPeer::addSelectColumns($criteria);
				if (!isset($this->lastSocialLoginsCriteria) || !$this->lastSocialLoginsCriteria->equals($criteria)) {
					$this->collSocialLoginss = SocialLoginsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSocialLoginsCriteria = $criteria;
		return $this->collSocialLoginss;
	}

	/**
	 * Returns the number of related SocialLoginss.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSocialLoginss($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSocialLoginsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SocialLoginsPeer::USER_ID, $this->getId());

		return SocialLoginsPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SocialLogins object to this object
	 * through the SocialLogins foreign key attribute
	 *
	 * @param      SocialLogins $l SocialLogins
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSocialLogins(SocialLogins $l)
	{
		$this->collSocialLoginss[] = $l;
		$l->setUsers($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseUsers:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseUsers::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseUsers
