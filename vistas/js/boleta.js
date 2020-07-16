

/*=============================================
CAMBIAR LA TABLA DINAMICA
=============================================*/

var table =$(".tablaboleta").dataTable({

    "ajax":"ajax/boleta.ajax.php",
    "columnDefs": [ {
        "targets": -1,
        "data": null,
        "defaultContent":'<div class="btn-group"><button class="btn btn-warning idmateria"> <i class="fa fa-pencil"></i></button><button class="btn btn-danger idmateria"> <i class="fa fa-times"></i></button></div>'
        } ]
})

$('#tablaboleta tbody').on( 'click', 'button', function () {
    var data = table.row( $(this).parents('tr') ).data();
    alert( data[0] +"'s salary is: "+ data[ 9 ] );
} );