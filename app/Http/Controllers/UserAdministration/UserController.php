<?php

namespace App\Http\Controllers\UserAdministration;

use App\Http\Requests\UserAdministration\StoreUserRequest;
use App\Http\Requests\UserAdministration\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Services\UserAdministration\UserService;
use App\Http\Requests\UserAdministration\UserRequest;

class UserController extends UserAdministrationController
{
    public UserService $userService;
    public User $userEntity;

    public function __construct(
        User $userEntity,
        UserService $userService
    ) {
        parent::__construct();

        $this->view .= "user.";

        $this->userService = $userService;
        $this->userEntity = $userEntity;
    }

    public function getData(Request $request)
    {
        return $this->userService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView(
            "index",
            $this->userService->indexProperties(),
        );
    }

    public function getCreate()
    {
        return $this->makeView(
            "form",
            $this->userService->createProperties(),
        );
    }

    public function postCreate(StoreUserRequest $request)
    {
        return $this->userService->create($request);
    }

    public function getEdit($id)
    {
        return $this->makeView(
            "form",
            $this->userService->editProperties($id),
        );
    }

    public function postEdit(UpdateUserRequest $request, $id)
    {
        return $this->userService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->userService->delete($id);
    }

    public function getEnable($id)
    {
        return $this->userService->enable($id);
    }

    public function getDisable($id)
    {
        return $this->userService->disable($id);
    }
}
