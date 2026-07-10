<?php

namespace App\Repositories\Eloquent;

use App\Models\SeoSetting;
use App\Repositories\Contracts\SeoSettingRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SeoSettingRepository
 * 
 * Repository pour la gestion des paramètres SEO
 */
class SeoSettingRepository extends BaseRepository implements SeoSettingRepositoryInterface
{
    /**
     * SeoSettingRepository constructor.
     *
     * @param SeoSetting $model
     */
    public function __construct(SeoSetting $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritdoc}
     */
    public function getByPage(string $page): ?Model
    {
        return $this->query()->where('page', $page)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function updateForPage(string $page, array $data): Model
    {
        $seo = $this->getByPage($page);

        if ($seo) {
            return $this->update($seo, $data);
        }

        $data['page'] = $page;
        return $this->create($data);
    }
}