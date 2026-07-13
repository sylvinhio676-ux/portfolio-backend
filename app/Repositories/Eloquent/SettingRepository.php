<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting;
use App\Repositories\Contracts\SettingRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SettingRepository
 *
 * Repository pour la gestion des paramètres globaux (ligne unique).
 */
class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    /**
     * SettingRepository constructor.
     *
     * @param Setting $model
     */
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritdoc}
     */
    public function getSetting(): ?Model
    {
        return $this->query()->first();
    }

    /**
     * {@inheritdoc}
     */
    public function updateSetting(array $data): Model
    {
        $setting = $this->getSetting();

        if ($setting) {
            return $this->update($setting, $data);
        }

        return $this->create($data);
    }
}
