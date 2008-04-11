<?php
class userComponents extends sfComponents
{
  public function executeVocabularyUserList()
  {
    $c = new Criteria();
    $c->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->vocabularyId);
    $c->addAscendingOrderByColumn(UserPeer::LAST_NAME);
    $this->users = VocabularyHasUserPeer::doSelectJoinUser($c);
  }
  public function executeSchemaUserList()
  {
    $c = new Criteria();
    $c->add(SchemaHasUserPeer::SCHEMA_ID, $this->schemaId);
    $c->addAscendingOrderByColumn(UserPeer::LAST_NAME);
    $this->users = SchemaHasUserPeer::doSelectJoinUser($c);
  }
}
