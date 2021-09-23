<?php
namespace App\Repository;

interface JobRepositoryInterface
{
    public function all();
    public function paginate();
    public function find($id);
    public function store($request);
    /**
     * @param $id
     * @return Model
     */
    public function update($id, array $requestData, $withTrash = false);
    public function destroy($id);

}
