<?php



namespace Drupal\jz_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
/**
 * Defines a route controller for entity autocomplete form elements.
 */
class PedigreController extends ControllerBase {

  public function pedigretable(Request $request)
    {
      $matches = [];
      $string = $request->query->get('q');

      $query = \Drupal::database()->select('node__field_loazon_long', 'la');
      $query->fields('la', ['field_loazon_long_value', 'entity_id']);
      //$query->condition('la.field_loazon_long_value', '%' . $string . '%', 'LIKE');
      $query->condition('la.field_loazon_long_value', $string . '%', 'LIKE');
      $result = $query->execute();

      foreach ($result as $row) {
        //$matches[] = ['value' => $row->entity_id, 'label' => $row->field_loazon_long_value];
        $matches[] = ['value' => $row->field_loazon_long_value, 'label' => $row->field_loazon_long_value];
      }

      return new JsonResponse($matches);
    }
    
    
    //public function foo() {
    //...
    //return $this->redirect('hello.content');
    //}
    
}
