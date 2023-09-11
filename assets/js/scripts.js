(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		
		$('.service-item .service-title').click(function() {
			// Obtener el elemento padre
			const serviceItem = $(this).parent();
			
			// Comprobar si el elemento ya tiene la clase "show-details"
			if (serviceItem.hasClass('show-details')) {
				// Si ya tiene la clase, se la quitamos
				serviceItem.removeClass('show-details');
			} else {
				// Eliminar la clase "show-details" de otros elementos con la misma clase
				$('.service-item').not(serviceItem).removeClass('show-details');
				
				// Si no tiene la clase, se la agregamos
				serviceItem.addClass('show-details');
			}
		});      

		//scroll Trigger
		gsap.registerPlugin(ScrollTrigger);
		
		// Creamos una animación de entrada con GSAP 
		const loadingTimeline = gsap.timeline({ paused: true });
		loadingTimeline.to(".loader", { width:0, height:0, duration: .25, delay:.5 });
		//loadingTimeline.from(".header", { opacity: 0, y:-200, duration: .5, delay:.1 });
		//loadingTimeline.from('#hero .cta-content', { opacity: 0, x:200, duration: .5, delay:.1 });
		//loadingTimeline.from('#hero .absolute-image', { opacity: 0, y:200, duration: .5, });
		loadingTimeline.play();

		//About section timeline
		const aboutTimeline = gsap.timeline({
			scrollTrigger:{
				trigger: '#about',
				start:"top 70%",
			//	markers:true,
				scrub:true,
				endTrigger: "#about",
				end: "bottom 70%"
			}
		})
		// aboutTimeline.from("#about .vc_parallax",{		
		// 	scale: 1.5,
		// 	duration: 1,
		// 	ease: 'power2.out',
		// })
		aboutTimeline.from("#about h2", {
			opacity: 0,
			y: 50,
			duration: 1,
			ease: 'power2.out',
		});

		//Services section timeline
		const servicesTimeline = gsap.timeline({
			scrollTrigger:{
				trigger: '#services',
				start:"top center",
			//	markers:true,
			//	scrub:true,
				endTrigger: "#services",
				end: "bottom 80%"
			}
		})
		servicesTimeline.from("#services .trade-gothic", {	
			opacity:0,
			y:50,
			duration: 1,
			ease: 'power2.out',
		});	
		// servicesTimeline.from("#services .agc-services",{		
		// 	opacity:0,
		// 	scale: 10,
		// 	rotate:-30,
		// 	duration: 1,
		// 	ease: 'power2.out',
		// })

		servicesTimeline.from("#services .service-title h2", 0.8, {
			y: 100,
			ease: "power4.out",
			skewY: 7,
			stagger: {
				amount: 0.7
			}
		})

		//Extra section Timeline
		const extraTimeline = gsap.timeline({
			scrollTrigger:{
				trigger: '#extra',
				start:"top center",
			//	markers:true,
				scrub:true,
				endTrigger: "#extra",
				end: "bottom 60%"
			}
		}
		);
		extraTimeline.from("#extra .vc_inner h2", 1.8, {
			y: 100,
			ease: "power4.out",
			delay: 1,
			skewY: 7,
			stagger: {
				amount: 0.5
			}
		})
		
		//Team section Timeline
		const team = document.querySelector('#team');
		const members = team.querySelectorAll('.agc-team-member');
		const teamTimeline = gsap.timeline({
		   scrollTrigger: {
			   trigger: "#team",
			   start: 'top center',
			   endTrigger: "#team",
			   end: 'bottom bottom',
			   scrub: true,
		   },
	   });
		teamTimeline.from(members, {
		   opacity: 0,
		   x: 150,
		   stagger: 0.5, // Retardo entre las animaciones de cada imagen
		   duration: 1,
		   ease: 'power2.out',
		});

		//Clients Section Timeline
		const clients = document.querySelector('.agc-logo-gallery');
		const logos = clients.querySelectorAll('img');
		const clientsTimeline = gsap.timeline({
		   scrollTrigger: {
			   trigger: "#clients",
			   start: 'top center',
			   endTrigger: "#clients",
			   end: 'bottom bottom',
			   scrub: true,
		   },
	   	});
		servicesTimeline.from("#clients .trade-gothic", {	
			opacity:0,
			y:50,
			duration: 1,
			ease: 'power2.out',
		});	
		clientsTimeline.from(logos, {
		   opacity: 0,
		   y: 50,
		   stagger: 0.5, // Retardo entre las animaciones de cada imagen
		   duration: 1,
		   ease: 'power2.out',
		});

		//Contact Section Timeline
		const contact = document.querySelector('#contact form');
		const fields = contact.querySelectorAll('p');   
		const contactTimeline = gsap.timeline({
			scrollTrigger: {
				trigger: "#contact",
				start: 'top center',
				endTrigger: "#contact",
				end: '80% bottom',
				scrub: true,
			},
		});
		contactTimeline.from('#contact h2', {
			opacity: 0,
			y: 50,
			duration: 1,
			ease: 'power2.out',
		});
		contactTimeline.from(fields, {
			opacity: 0,
			y: 50,
			stagger: 0.5, // Retardo entre las animaciones de cada imagen
			duration: 1,
			ease: 'power2.out',
		});
 
		const ham = document.querySelector(".menu-button");
		if(ham){
			const menu = document.querySelector('.nav');
			const links = menu.querySelectorAll('ul li');
			const sml = menu.querySelectorAll('.social-media-links a');
	
			var tl = gsap.timeline({ paused: true });
	
			tl.to(menu, {
				duration: .5,
				opacity: 1,
				height:'100vh',
				zIndex:100,
				ease: 'power1.out',
			})
			tl.from(links, {
				delay:.3,
				duration: .5,
				opacity: 0,
				y: 20,
				stagger: 0.1,
				ease: 'power1.out',
			});
			tl.from(sml, {
				delay:.1,
				duration: .5,
				opacity: 0,
				y: 20,
				stagger: 0.1,
				ease: 'power1.out',
			});
	
			tl.reverse();
	
			ham.addEventListener('click', () => {
				tl.reversed(!tl.reversed());
				ham.classList.toggle('active')
				document.querySelector('body').classList.toggle('nav-is-open')
			});

		}
		
		// $(".img-carousel").each(function(index, el) {
		// 	var containerHeight = $(el).height();
		// 	$(el).find("img").each(function(index, img) {
		// 		var w = $(img).attr('width');
		// 		var h = $(img).attr('height');
		// 	  console.log(img,w,h)
		// 	  $(img).css({
		// 		'width': Math.round(containerHeight * w / h) + 'px',
		// 		'height': containerHeight + 'px'
		// 	  });
		// 	}),
		// 	$(el).owlCarousel({
		// 	  autoWidth: true,
		// 	  margin:15
		// 	});
		// });

		// let options = {
		// 	"cursorOuter": "disable",
		// 	"hoverEffect": "pointer-overlay",
		// 	"hoverItemMove": false,
		// 	"defaultCursor": false,
		// 	"outerWidth": 30,
		// 	"outerHeight": 30
		// }; 
		// magicMouse(options);

		

		//GSAP Animations
		if(document.querySelector(".agc-page-banner")){
			gsap.from(".agc-page-banner .title",{
				opacity:0,
				duration:1,
				delay:1
			})
			gsap.from(".agc-page-banner .description",{
				opacity:0,
				duration:1,
				delay:2
			})
			gsap.from(".agc-page-banner .image",{
				opacity:0,
				duration:1,
				y:-200,
				delay:3
			})
			gsap.from(".agc-page-banner .square",{
				opacity:0,
				x:200,
				duration:1,
				delay:3
			})

		}
		
		let fade_galleries = document.querySelectorAll(".fade-in-gallery");
		if(fade_galleries){
			fade_galleries.forEach(gallery => {
			let slides = gallery.getElementsByTagName("img");
			let current = 0

			setInterval(function() {
				for (let i = 0; i < slides.length; i++) {
					slides[i].style.opacity = 0;
				}
				current = (current != slides.length - 1) ? current + 1 : 0;
				slides[current].style.opacity = 1;
			}, 4000);
			})
		}

		if(document.querySelector(".agc-gallery-banner")){
			gsap.from(".agc-gallery-banner",{
				opacity:0,
				duration:2,
				delay:2
			})
			
			gsap.to(".agc-gallery-banner .gallery",{
				scrollTrigger:{
					trigger:".agc-gallery-banner",
					start:"start 0%",
					scroller: ".scroller",
					end:"bottom 20%",
					scrub:.2
				},
				y:.2*-innerHeight,
				opacity:0,
				ease:"power1.out"
			})
			gsap.to(".agc-gallery-banner .square",{
				scrollTrigger:{
					trigger:".agc-gallery-banner",
					start:"start 0%",
					scroller: ".scroller",
					end:"bottom 20%",
					scrub:.2
				},
				x:.2*innerHeight,
				opacity:0,
				ease:"power1.out"
			})
		}
		

		const items = document.querySelectorAll(".agc-animated-counter .counter");
		if(items.length){
			gsap.from(items, {
				scrollTrigger:{
					trigger:"#brands",
					start:"top center",
					toggleActions: "restart none none none"
				},
				textContent: 0,
				duration: 3,
				ease: "power1.in",
				snap: { textContent: 1 },
				stagger: {
					each: 0.2,
					// onUpdate: function() {
					// this.targets()[0].innerHTML = numberWithCommas(Math.ceil(this.targets()[0].textContent));
					// },
				}
			});
		}
		

		// // each time the window updates, we should refresh ScrollTrigger and then update LocomotiveScroll. 
		// ScrollTrigger.addEventListener("refresh", () => locoScroll.update());

		// // after everything is set up, refresh() ScrollTrigger and update LocomotiveScroll because padding may have been added for pinning, etc.
		// ScrollTrigger.refresh();

		let post_img_wrap = document.querySelectorAll(".single-post .post-content p")
		if(post_img_wrap){
			post_img_wrap.forEach((p) => {
				if(p.getElementsByTagName('img')[0]){
					console.log(p.getElementsByTagName('img'))
					p.classList.add("images")
				}
			})
		}
		
		//MARQUEE
		function Marquee(selector, speed) {
			const parentSelector = document.querySelector(selector);
			const clone = parentSelector.innerHTML;
			const firstElement = parentSelector.children[0];
			let i = 0;
			console.log(firstElement);
			parentSelector.insertAdjacentHTML('beforeend', clone);
			parentSelector.insertAdjacentHTML('beforeend', clone);
		  
			setInterval(function () {
			  firstElement.style.marginLeft = `-${i}px`;
			  if (i > firstElement.clientWidth) {
				i = 0;
			  }
			  i = i + speed;
			}, 0);
		  }
		  
		  //after window is completed load
		  //1 class selector for marquee
		  //2 marquee speed 0.2
		  window.addEventListener('load', () => {
			  if(document.querySelector(".marquee")){
				  Marquee('.marquee', 0.2)
			  }
		  })
		  
	});
		
	
})(jQuery, this);

// Obtener el elemento del encabezado (header)
const header = document.querySelector('header');

// Función para verificar el desplazamiento y cambiar la apariencia del encabezado
function checkScroll() {
  // Obtener la altura de la ventana del navegador
  const windowHeight = window.innerHeight;

  // Obtener la posición actual del scroll vertical
  const scrollPosition = window.scrollY || window.pageYOffset;

  if(scrollPosition > windowHeight/2){	
    header.classList.add('blur');
  } else {
    header.classList.remove('blur');
  }
}

// Escuchar el evento de scroll y llamar a la función
window.addEventListener('scroll', checkScroll);

// Llamar a la función al cargar la página
checkScroll();
