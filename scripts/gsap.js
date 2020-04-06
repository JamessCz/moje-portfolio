const nav = document.querySelector('nav');
const ban = document.querySelector('.banner-bg');
const her = document.querySelector('.hero');

const tl = new TimelineMax();

tl.fromTo(
    ban,
    0.6,
    {x: "-100%"},
    {x: "0%", ease: Power2.easeInOut}
).fromTo(
    nav, 
    0.6, 
    {top: "-50px"}, 
    {top: "0", ease: Power2.easeInOut}
).fromTo(
    nav, 
    0.6,
    {width: "600px"},
    {width: "100%", ease: Power2.easeInOut}
).fromTo(
    her, 
    0.2, 
    {opacity: 0}, 
    {opacity: 1}
);


