var candidate_num = 1;
function updateList(count) {
    if (count < candidate_num) {
        return;
    }
    candidate_num++; 
    $("#candidateList").append('<input type="text" class="form-control" name="candidate-' + candidate_num +
        '" id="candidate-' + candidate_num + '">');
    $('#candidate-' + candidate_num).keyup(function(){
        if($(this).val().length > 0) {
            updateList(count+1);
        }
    });
}

$(document).ready(function(){
    $('#candidate-1').keyup(function(){
        console.log("run");
        if($(this).val().length > 0) {
            updateList(1);
        }
    });
});
