function castVote(index, poll) {
    var candidates = $('.candidate');
    var dict = {};
    for (var i = 0; i < candidates.length; i++) {
        var id = candidates[i].id;
        dict[i] = Number(id.substring(id.indexOf('-')+1));
    }
    dict["poll"] = poll;
    console.log(dict);
    $.post('castVote.php', dict, function(){
        window.open("results.php?poll=" + poll,"_self");
    });
}

function rowUp(num) {
    var div = "#candidate-"+num;
    var prev = $(div).prev('div');
    $(div).insertBefore(prev);
}

function rowDown(num) {
    var div = "#candidate-"+num;
    var next = $(div).next('div');
    $(div).insertAfter(next);
}
