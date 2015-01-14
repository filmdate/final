function eliminar(id){

    $.get("../model/borrar.php?id="+id, function(data) {

        $('#fila_'+id).remove();
        
    });

}