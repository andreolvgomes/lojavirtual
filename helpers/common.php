<?php

function format_decimal_simbolo($number) {
    //return 'R$ ' . number_format($number);
    return 'R$ ' . number_format($number, 2, ",", ".");
}

function format_decimal($number) {
    //return 'R$ ' . number_format($number);
    return number_format($number, 2, ",", ".");
}

function format_datetime($datetime) {
    return date_format($datetime, "Y/m/d H:i:s");
}

function pretty_date($date) {
    return date("M d, Y h:i A", strtotime($date));
}

function status_andamento_compra($car_status_andamento) {
    if ($car_status_andamento == 0) {
        return "Em Analise";
    } else if ($car_status_andamento == 1) {
        return "Aprovada";
    } else if ($car_status_andamento == 2) {
        return "Entrega Concluída";
    } else if ($car_status_andamento == 24) {
        return "Recusada";
    }
    return "Status não definido";
}

function display_errors($errors) {
//    $display = '<div id="errors" class="alert alert-danger">';
//    foreach ($errors as $error) {
//        $display .= '<li>' . $error . '</li>';
//    }
//    $display .= '</div>';
//    return $display;
//        <div class="alert alert-block alert-success">
//        <a class="close" data-dismiss="alert" href="#">X</a>
//        <h4 class="alert-heading">Success!</h4>
//        Congratulations, you have successfully submitted.
//    </div>
//    <div class="alert alert-block alert-info">
//        <a class="close" data-dismiss="alert" href="#">X</a>
//        <h4 class="alert-heading">Info</h4>
//        This is some informational text...
//    </div>
//    $display = '<div class="alert alert-block alert-success alert alert-danger">';
//    $display .= '<a class="close" data-dismiss="alert" href="#">X</a>';
//    $display .= '<h4 class="alert-heading">Atenção !</h4>';
//    foreach ($errors as $error) {
//        $display .=  $error;
//    }
//    $display .= '</div>';
//    return $display;
//    
    //     <div class="alert alert-dismissable alert-warning">
//        <button type="button" data-dismiss="alert" class="close">×</button>Warning! Warning!
//    </div>
//    <div class="alert alert-dismissable alert-danger">
//        <button type="button" data-dismiss="alert" class="close">×</button>Danger Will Robinson!
//    </div>
//    <div class="alert alert-dismissable alert-success">
//        <button type="button" data-dismiss="alert" class="close">×</button>You succeeded :-)
//    </div>
//    <div class="alert alert-dismissable alert-info">
//        <button type="button" data-dismiss="alert" class="close">×</button>Some information for you
//    </div>

    $display = '<div class="alert alert-dismissable alert-danger">';
    $display .= '<button type="button" data-dismiss="alert" class="close">×</button>';
    foreach ($errors as $error) {
        $display .= '<li>' . $error . '</li>';
    }
    $display .= '</div>';
    return $display;
}
