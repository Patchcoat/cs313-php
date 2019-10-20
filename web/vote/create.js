var candidate_num = 1;
function updateList() {
    candidate_num++; 
    $("#candidateList").append('<input type="text" class="form-control" id="candidate-' + candidate_num + '">');
    $('#candidate-' + candidate_num).change(function(){
        if($(this).val().length > 0) {
            updateList();
        }
    });
}

$(document).ready(function(){
    $('#candidate-1').change(function(){
        if($(this).val().length > 0) {
            updateList();
        }
    });
});
