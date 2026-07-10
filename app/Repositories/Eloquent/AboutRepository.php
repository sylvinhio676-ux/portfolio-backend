<?php

namespace App\Repositories\Eloquent;

use App\Models\About;
use App\Repositories\Contracts\AboutRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AboutRepository
 * 
 * Repository pour la gestion des informations "À propos"
 */
class AboutRepository extends BaseRepository implements AboutRepositoryInterface
{
    /**
     * AboutRepository constructor.
     *
     * @param About $model
     */
    public function __construct(About $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritdoc}
     */
    public function getAbout(): ?Model
    {
        return $this->query()->first();
    }

    /**
     * {@inheritdoc}
     */
    public function updateAbout(array $data): Model
    {
        $about = $this->getAbout();

        if ($about) {
            return $this->update($about, $data);
        }

        return $this->create($data);
    }
}