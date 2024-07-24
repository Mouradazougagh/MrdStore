document.addEventListener('DOMContentLoaded', function() {

    var blackRadio = document.getElementById('black');
    var whiteRadio = document.getElementById('white');
    var watch1 = document.getElementById('watch1');
    var watch2 = document.getElementById('watch2');

    blackRadio.addEventListener('click', function() {
        watch1.style.display = 'block';
        watch2.style.display = 'none';
    });

    whiteRadio.addEventListener('click', function() {
        watch1.style.display = 'none';
        watch2.style.display = 'block';
    });
});

