<?php

namespace App\Controller;

use App\Contracts\DataManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {

  /**
   * @var DataManagerInterface
   */
  protected $dataManager;

  /**
   * Constructs a AdminController object.
   *
   * @param \App\Contracts\DataManagerInterface $data_manager
   */
  public function __construct(DataManagerInterface $data_manager) {
    $this->dataManager = $data_manager;
  }

  /**
   * @route("/admin/init")
   */
  public function initialize() {
    $this->dataManager->loadWeeks();
    $this->dataManager->loadNflTeams();
  //  $this->dataManager->loadPlayers();
    return new Response("Player Data Loaded");
  }
}
