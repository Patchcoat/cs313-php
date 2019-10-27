var candidate_num = 1;
function updateList() {
    candidate_num++; 
    $("#candidateList").append('<input type="text" class="form-control" name="candidate-' + candidate_num +
        '" id="candidate-' + candidate_num + '">');
    $('#candidate-' + candidate_num).change(function(){
        if($(this).val().length > 0) {
            updateList();
        }
    });
}

$(document).ready(function(){
    $('#candidate-1').change(function(){
        console.log("run");
        if($(this).val().length > 0) {
            updateList();
        }
    });
});
