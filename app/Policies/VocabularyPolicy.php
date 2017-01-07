<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\Vocabulary;
use Illuminate\Auth\Access\HandlesAuthorization;

class VocabularyPolicy
{
  use HandlesAuthorization;


  /**
   * Determine whether the user can view the vocabulary.
   *
   * @param  User $user
   * @param  Vocabulary $vocabulary
   *
   * @return mixed
   */
  public function view(User $user, Vocabulary $vocabulary)
  {
    //
  }


  /** * Determine whether the user can create vocabularies.
   *
   * @param  User $user
   *
   * @return mixed
   */
  public function create(User $user)
  {
    //
  }


  public function listTableForeignKeys($table)
  {
    $conn = SchemaL::getConnection()->getDoctrineSchemaManager();

    return array_map(

        function ($key) {
          /** @var \Doctrine\DBAL\Schema\ForeignKeyConstraint $key */
          return $key->getName();
        },
        $conn->listTableForeignKeys($table));
  }pdate the vocabulary.
   *
   * @param  User $user
   * @param  Vocabulary $vocabulary
   *
   * @return mixed
   */
  public function update(User $user, Vocabulary $vocabulary)
  {
    //
  }


  /**
   * Determine whether the user can delete the vocabulary.
   *
   * @param  User $user
   * @param  Vocabulary $vocabulary
   *
   * @return mixed
   */
  public function delete(User $user, Vocabulary $vocabulary)
  {
    //
  }
}
