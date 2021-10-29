$().ready(function () {

    footerResize();
    listsEditDeleteIconsMove();

    $(window).resize(function() {
        footerResize();
        listsEditDeleteIconsMove();
    });

});

/*Le calcul du footer.Width() se fait en prenant la largeur du content box du <nav> 
  plus les paddings gauche et droite du <nav> (2*16) moins les paddings gauche et 
  droite du <footer> (2*60) .
  Ce qui donne un réajustement à 32-120=-88
  */
function footerResize() {
    var navWidth = $('nav').width();
    // console.log(navWidth);
    $('footer').width(navWidth-88);
}

function listsEditDeleteIconsMove() {
    if ($(window).width() < 989) {
        $('#prospectnclientlist>tbody tr td:last-of-type').removeClass('text-center');
        $('#categorylist>tbody tr td:last-of-type').removeClass('text-center');
    } else {
        $('#prospectnclientlist>tbody tr td:last-of-type').addClass('text-center');
        $('#categorylist>tbody tr td:last-of-type').addClass('text-center');
    }
}