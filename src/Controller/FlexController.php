<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlexController extends AbstractController {

  /**
   * @return \Symfony\Component\HttpFoundation\Response
   *
   * @route("/totals")
   */
  public function displayTotals() {
    return new Response('<html><body>Totals go here</body></html>');
  }
}
