<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface
 * 
 * Interface de base pour tous les repositories
 * Définit les opérations CRUD communes
 */
interface RepositoryInterface
{
    /**
     * Récupérer tous les enregistrements
     *
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * Récupérer tous les enregistrements avec pagination
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate(int $perPage = 15, array $columns = ['*']);

    /**
     * Trouver un enregistrement par son ID
     *
     * @param int $id
     * @param array $columns
     * @return Model|null
     */
    public function find(int $id, array $columns = ['*']): ?Model;

    /**
     * Trouver un enregistrement par son ID ou échouer
     *
     * @param int $id
     * @param array $columns
     * @return Model
     */
    public function findOrFail(int $id, array $columns = ['*']): Model;

    /**
     * Trouver un enregistrement par un champ spécifique
     *
     * @param string $field
     * @param mixed $value
     * @param array $columns
     * @return Model|null
     */
    public function findBy(string $field, $value, array $columns = ['*']): ?Model;

    /**
     * Récupérer les enregistrements par un champ spécifique
     *
     * @param string $field
     * @param mixed $value
     * @param array $columns
     * @return Collection
     */
    public function getBy(string $field, $value, array $columns = ['*']): Collection;

    /**
     * Créer un nouvel enregistrement
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Mettre à jour un enregistrement
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data): Model;

    /**
     * Mettre à jour ou créer un enregistrement
     *
     * @param array $attributes
     * @param array $values
     * @return Model
     */
    public function updateOrCreate(array $attributes, array $values = []): Model;

    /**
     * Supprimer un enregistrement
     *
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool;

    /**
     * Supprimer un enregistrement par son ID
     *
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;

    /**
     * Compter le nombre d'enregistrements
     *
     * @return int
     */
    public function count(): int;

    /**
     * Récupérer les enregistrements avec des relations
     *
     * @param array $relations
     * @param array $columns
     * @return Collection
     */
    public function with(array $relations, array $columns = ['*']): Collection;

    /**
     * Récupérer les enregistrements triés
     *
     * @param string $column
     * @param string $direction
     * @param array $columns
     * @return Collection
     */
    public function orderBy(string $column, string $direction = 'asc', array $columns = ['*']): Collection;
}