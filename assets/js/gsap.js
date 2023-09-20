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