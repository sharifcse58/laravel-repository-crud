<?php
namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{

    /**
     * @param array $attributes
     * @return Model
     */
    public function store(Request $attributes);

    /**
     * @param $id
     * @return Model
     */
    public function update($id, array $requestData, $withTrash = false);

    /**
     * @param $id
     * @return Model
     */
    public function destroy($id);
}
