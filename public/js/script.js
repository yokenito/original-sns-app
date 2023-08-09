function nice(post_id, elm){
    var url = `/original-sns-app/public/posts/nice/${post_id}`;
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url,
        type: "POST",
    })
        .done(function(data){
            if(elm.classList.contains('active')){
                $('.active').css('display', 'none');
                $('.nonactive').css('display', 'block');
            } else {
                $('.nonactive').css('display', 'none');
                $('.active').css('display', 'block');
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            console.log('失敗');
        });
}

// 面白いボタン
function funny(post_id, elm){
    var url = `/original-sns-app/public/posts/funny/${post_id}`;
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url,
        type: "POST",
    })
        .done(function(data){
            if(elm.classList.contains('fun-active')){
                $('.fun-active').css('display', 'none');
                $('.fun-nonactive').css('display', 'block');
            } else {
                $('.fun-nonactive').css('display', 'none');
                $('.fun-active').css('display', 'block');
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            console.log('失敗');
        });
}

// 感動ボタン
function shine(post_id, elm){
    var url = `/original-sns-app/public/posts/shine/${post_id}`;
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url,
        type: "POST",
    })
        .done(function(data){
            if(elm.classList.contains('shine-active')){
                $('.shine-active').css('display', 'none');
                $('.shine-nonactive').css('display', 'block');
            } else {
                $('.shine-nonactive').css('display', 'none');
                $('.shine-active').css('display', 'block');
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            console.log('失敗');
        });
}


// 面白いランキング
$('#searchperson-btn').on('click', function(){
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: `/original-sns-app/public/posts/funnyrank`,
        type: "POST",
        // data:{
            
        // }
    })
        .done(function(data){
            // 検索結果を受け取って一覧を表示
            $('#personsearch-result').empty();
            for(i=0; i < data.length; i++){
                $('#personsearch-result').append('<button class="person-set btn btn-outline-dark ms-2" value="' + data[i].id + '">' + data[i].person_name + '</button>');
            }
            $('.person-set').on('click', function(){
                var person_id = $(this).val();
                var person_name = $(this).text();
                console.log(person_name, person_id);
                $('#set-person').val(person_name);
                $('#set-person-id').val(person_id);
                $('#searchPersonModal').modal('hide');
            });
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            console.log('失敗');
        });
});
