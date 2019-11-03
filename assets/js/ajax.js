;(function(win,doc,$){

    var $win = $(win),
        $doc = $(doc)

    $doc.ready(function(){

        var loadingScreen = $('.progress');
        var cardStaff = $('#staff');
        var staffForm = $('.form-holder');

        var generateStaffCard = function(data) {
            var template = '<div class="staff-card">';
                template    += '<div class="avatar">'
                template        +='<img  title="' + data.first_name + ' ' + data.last_name + '"  src="' + data.image + '" />'
                template    += '</div>'
                template    += '<div class="content">'
                template        +='<h2>' + 'Name:' + ' ' + '<span>' + data.first_name + ' ' + data.last_name + '</span>' + '</h2>'
                template        +='<h2>' + 'Position:' + ' ' + '<span>' + data.position_name + '</span>' + '</h2>'
                template        +='<h2>' + 'Currency:' + ' ' + '<span>' + data.currency_name + '</span>' + '</h2>'
                template        +='<h2>' + 'Salary:' + ' ' + '<span>' + data.salary + '</span>' + '</h2>'
                template        +='<h2>' + 'Date of Birth:' + ' ' + '<span>' + data.birth_date + '</span>' + '</h2>'
                template        +='<h2>' + 'Gender:' + ' ' + '<span>' + data.gender + '</span>' + '</h2>'
                template    += '</div>'
                template += '</div>'
            
            return {
                template: template,
                $: $(template)
            }
        }

        $.ajax({
            method: 'GET',
            dataType: 'json',
            url: 'staff.php',

            beforeSend: function(){

            },

            success: function(staff) {
                setTimeout(function() {
                    loadingScreen.animate({
                        opacity: 0
                    },
                    500,
                    function() {
                        loadingScreen.remove();

                        cardStaff.empty();

                        staffForm.addClass('visible');

                    staff.forEach(function(el, index){
                        var card = new generateStaffCard(el);
                        cardStaff.append(card.$);

                        setTimeout( function () {
                            card.$.css({
                                opacity: 1,
                                top: 0
                            });
                        }, 200 * index)
                    });
                    }
                    )
                }, 1500)

                
            },

            error: function() {
                
            }
        })
    });

})(window,document,jQuery);