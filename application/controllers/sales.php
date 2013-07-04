<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

class Sales extends MY_Auth {

    public function __construct() {
        parent::__construct();
        $this->load->model('Access_model'); //Loading access model
    }

    public function index() {

        //Loading Main menu links
        $menuLinks = $this->Access_model->mainMenuLinks($this->current_user[0]['id']);
        $data['menuLinks'] = $menuLinks;
        //loading the template
        $tpl = $this->tpl();
        $data['addLink'] = $tpl['addLink'];
        $data['tableBody'] = $tpl['tableBody'];
        $data['pageTitle'] = $tpl['pageTitle']; //Assign page title
        $data['container'] = 'modules/sales/index'; //Assign page content
        $this->load->view('index', $data); //Loading default view
    }

    protected function tpl() {
        $pageTitle = 'Sales'; //Page title
        $tableBody = '';
//        $customers = $this->customers_model->getCustomerDetails();
        $path = array('add' => 'sales/add',
            'edit' => 'sales/edit',
            'delete' => 'sales/delete');
        $tableBody='';
        //Loading Data table links
        $actionLinks = $this->Access_model->actionLinks($this->current_user[0]['id'], $this->router->fetch_class(), $path);
//        foreach ($customers->result_array() as $key => $value) {
//            $tableBody .= "<tr>
//                <td>" . $value['first_name'] . "</td>
//                <td>" . $value['last_name'] . "</td>
//                <td>" . $value['email'] . "</td>
//                <td>" . $value['phone_number'] . "</td>
//                <td>" . str_replace('replaceId', $value['id'], $actionLinks['dataTableActionLinks']) . "</td>
//                </tr>";
//        }
        $addLink = $actionLinks['addLink'];
        return array('pageTitle' => $pageTitle,
            'tableBody' => $tableBody,
            'addLink' => $addLink);
    }

}

?>