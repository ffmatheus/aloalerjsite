<script src="//code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.20/vue.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.0/vue-resource.min.js"></script>

<script>
    var isShowing = false;

    jQuery(function()
    {
        jQuery('#btn-telefones-uteis').click(function()
        {
            if ( ! isShowing)
            {
                jQuery('#agenda-tel-uteis').chatOnline(function()
                {
                    isShowing = true;
                });
            }
        });

        jQuery(document).click(function(evt)
        {
            if(jQuery(evt.target).closest('.agenda-tel-uteis').length)
            {
                return;
            }

            if(jQuery(evt.target).closest('.indice').length)
            {
                return;
            }

            if (isShowing)
            {
                jQuery('#agenda-tel-uteis').hide();

                isShowing = false;
            }
        });
    });
</script>

<script>
    $('#collapseOne').on('chatOnline.bs.collapse', function () {
        $('.panel-heading').animate({}, 500);
        $('.panel-heading').addClass('dropdown');
        $('.panel-heading').removeClass('dropup');
    })
    $('#collapseOne').on('hide.bs.collapse', function () {
        $('.panel-heading').animate({}, 500);
        $('.panel-heading').addClass('dropup');
        $('.panel-heading').removeClass('dropdown');

    })
</script>

<script>
    jQuery(document).ready(function ($) {
        setInterval(function () {
            moveRight();
        }, 3000);

        var slideCount = $('#slider ul li').length;
        var slideWidth = $('#slider ul li').width();
        var slideHeight = $('#slider ul li').height();
        var sliderUlWidth = slideCount * slideWidth;

        $('#slider').css({ width: slideWidth, height: slideHeight });

        $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });

        $('#slider ul li:last-child').prependTo('#slider ul');

        function moveLeft() {
            $('#slider ul').animate({
                left: + slideWidth
            }, 200, function () {
                $('#slider ul li:last-child').prependTo('#slider ul');
                $('#slider ul').css('left', '');
            });
        };

        function moveRight() {
            $('#slider ul').animate({
                left: - slideWidth
            }, 200, function () {
                $('#slider ul li:first-child').appendTo('#slider ul');
                $('#slider ul').css('left', '');
            });
        };

        $('a.control_prev').click(function () {
            moveLeft();
        });
    });
</script>

<script>
    new Vue({
        el: '#vue-app',

        data: {
            message: 'Hello Vue.js!',
            chatOnline: false,
        },

        methods:
        {
            __checkOnline: function()
            {
                console.log('looking for online users...');

                this.$http({url: '{{ env("CHAT_CLIENT_BASE_URL") }}/api/v1/chat/client/operators/online/for/client/{{ env('CHAT_CLIENT_ID') }}', method: 'GET'}).then(function (response)
                {
                    console.log('found '+response.data.length)
                    this.chatOnline = response.data.length > 0;
                }, function () {
                    this.chatOnline = false; /// error
                });
            }
        },

        ready: function()
        {
            this.__checkOnline();

            setInterval(function ()
            {
                this.__checkOnline();
            }.bind(this), 40 * 1000);
        }
    })
</script>
