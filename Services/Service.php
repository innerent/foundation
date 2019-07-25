<?php

namespace Innerent\Foundation\Services;

use Innerent\Foundation\Contracts\Repository;

abstract class Service
{
    protected $repo;

    function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    public function make(array $data)
    {
        return $this->repo->make($data);
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function update($id, array $data)
    {
        return $this->repo->get($id)->update($data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
