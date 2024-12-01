document.addEventListener("DOMContentLoaded", function () {
    var chatbot = document.getElementById("chatbot");
    var qoute = document.getElementById("qoute");
    var qoute2 = document.getElementById("qoute2");
    var chatBtn = document.getElementById("chat-btn");
    // var windowHeight = window.innerHeight;
    
    // Function for parallax scrolling
    function handleScroll() {
        var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
        
        // Move the image upwards
        var imageOffset = scrollPosition * 0.5; 
        chatbot.style.transform = `translateY(-${imageOffset}px)`;

        var textOffset = scrollPosition * 0.5;
        qoute.style.transform = `translateX(${textOffset}px)`;
        qoute2.style.transform = `translateX(${textOffset}px)`;
        chatBtn.style.transform = `translateX(${textOffset}px)`;
    }

    window.addEventListener("scroll", function () {
        requestAnimationFrame(handleScroll);
    });

    handleScroll(); 
});



// User Icon
document.addEventListener("DOMContentLoaded", function() {
const nav = document.querySelector("nav"),
toggleBtn = nav.querySelector(".toggle-btn");
toggleBtn.addEventListener("click" , () =>{
nav.classList.toggle("open");
});

});