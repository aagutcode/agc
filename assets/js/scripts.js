(function ($, root, undefined) {

		$(function () {

				'use strict';

				$('.service-item .service-title').click(function () {
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

				const ham = document.querySelector(".menu-button");
				if (ham) {
					const menu = document.querySelector('.nav');
					const links = menu.querySelectorAll('ul li');
					const sml = menu.querySelectorAll('.social-media-links a');

					var tl = gsap.timeline({
						paused: true
					});

					tl.to(menu, {
						duration: .5,
						opacity: 1,
						height: '100vh',
						zIndex: 100,
						ease: 'power1.out',
					})
					tl.from(links, {
						delay: .3,
						duration: .5,
						opacity: 0,
						y: 20,
						stagger: 0.1,
						ease: 'power1.out',
					});
					tl.from(sml, {
						delay: .1,
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

				let fade_galleries = document.querySelectorAll(".fade-in-gallery");
				if (fade_galleries) {
					fade_galleries.forEach(gallery => {
						let slides = gallery.getElementsByTagName("img");
						let current = 0

						setInterval(function () {
							for (let i = 0; i < slides.length; i++) {
								slides[i].style.opacity = 0;
							}
							current = (current != slides.length - 1) ? current + 1 : 0;
							slides[current].style.opacity = 1;
						}, 4000);
					})
				}



				let post_img_wrap = document.querySelectorAll(".single-post .post-content p")
				if (post_img_wrap) {
					post_img_wrap.forEach((p) => {
						if (p.getElementsByTagName('img')[0]) {
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
					if (document.querySelector(".marquee")) {
						Marquee('.marquee', 0.2)
					}
				})

				$("#temporal").owlCarousel({
					loop:true,
					nav:true,
					dots:false,
					margin:20,
					responsiveClass:true,
					responsive:{
					  0:{
						  items:1
					  },
					  1200:{
						  items:3
					  }
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

	if (scrollPosition > windowHeight / 2) {
		header.classList.add('blur');
	} else {
		header.classList.remove('blur');
	}
}

// Escuchar el evento de scroll y llamar a la función
//window.addEventListener('scroll', checkScroll);

// Llamar a la función al cargar la página
//checkScroll();

window.onload = function () {
	// Obtén una referencia al elemento <body>
	var bodyElement = document.body;

	// Agrega la clase deseada al elemento <body>
	bodyElement.classList.add("loaded");
}

var map;
var markers = [];
function initMap() {

	var mapStyle = [
		{
		  featureType: 'poi',
		  elementType: 'labels',
		  stylers: [{ visibility: 'off' }] // Oculta las etiquetas de los puntos de interés
		},
		{
		  featureType: 'road',
		  elementType: 'geometry',
		  stylers: [{ visibility: 'on' }] // Muestra las carreteras
		},
        {
          featureType: "all",
          stylers: [
            { saturation: -100 } // Saturación de -100
          ]
        }
	];

	var image = {
		url: 'wp-content/themes/agc/assets/img/marker.webp',
		size: new google.maps.Size(28, 34),
		anchor: new google.maps.Point(14, 34)
	};
  
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 16,
		styles: mapStyle
	});
	
	  // Obtener todos los elementos con clase 'location-card'
	var locationCards = document.querySelectorAll('.location-card');
	
	// Crear marcadores para cada 'location-card' y almacenarlos en el array 'markers'
	locationCards.forEach(function (card, index) {
		var lat = parseFloat(card.getAttribute('data-lat'));
		var lng = parseFloat(card.getAttribute('data-lng'));
	
		var marker = new google.maps.Marker({
			position: { lat: lat, lng: lng },
			map: map,
			icon:image,
			title: 'Lugar ' + (index + 1)
		});
	
		markers.push(marker);
	
		// Si es el primer marcador, establece el centro del mapa en sus coordenadas
		if (index === 0) {
			map.setCenter(marker.getPosition());
		}
	});

	// Agregar un evento al dropdown para cambiar el centro del mapa al seleccionar una opción
	var dropdown = document.getElementById('location-select');
	dropdown.addEventListener('change', function () {
		var selectedIndex = this.value;
		if (selectedIndex >= 0 && selectedIndex < markers.length) {
		map.setCenter(markers[selectedIndex].getPosition());
		}
	});
}

function initMaps() {
	// Encuentra todos los elementos con la clase 'map'
	var mapElements = document.querySelectorAll('.map');

	var mapStyle = [
		{
		  featureType: 'poi',
		  elementType: 'labels',
		  stylers: [{ visibility: 'off' }] // Oculta las etiquetas de los puntos de interés
		},
		{
		  featureType: 'road',
		  elementType: 'geometry',
		  stylers: [{ visibility: 'on' }] // Muestra las carreteras
		},
        {
          featureType: "all",
          stylers: [
            { saturation: -100 } // Saturación de -100
          ]
        }
	];
	

	// Itera a través de los elementos y crea un mapa para cada uno
	mapElements.forEach(function (element) {
		// Obtiene las coordenadas de latitud y longitud desde los atributos 'data-lat' y 'data-lng'
		var lat = parseFloat(element.getAttribute('data-lat'));
		var lng = parseFloat(element.getAttribute('data-lng'));

		// Crea un objeto LatLng con las coordenadas
		var myLatLng = { lat: lat, lng: lng };

		var image = {
			url: 'wp-content/themes/agc/assets/img/marker.webp',
			size: new google.maps.Size(40, 48),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(0, 32)
		  };

		// Crea un mapa y lo muestra en el elemento actual
		var map = new google.maps.Map(element, {
			center: myLatLng, // Establece el centro del mapa en las coordenadas especificadas
			zoom: 16, // Establece el nivel de zoom (puedes ajustarlo según tus necesidades)
			styles: mapStyle
		});

		// Crea un marcador en la ubicación especificada
		var marker = new google.maps.Marker({
			position: myLatLng,
			icon: image,
			map: map,
			title: 'Mi Ubicación' // Título del marcador (opcional)
		});
	});
}

// Función para cambiar el enfoque del mapa al marcador seleccionado
function focusMarker(markerIndex) {
	map.setCenter(markers[markerIndex].getPosition()); // Cambia el centro del mapa
}

 /* Custom Select */
var spanElement = document.querySelector('.selected-option');

spanElement.addEventListener('focus', function () {
  spanElement.classList.add('focus');
});

spanElement.addEventListener('blur', function () {
	setTimeout(function() {
		spanElement.classList.remove('focus');
	  }, 1000);	
});

var options = document.querySelectorAll('.options-list .option');
// Función para realizar un fadeOut
function fadeOut(element) {
    var opacity = 1;
    var fadeInterval = setInterval(function () {
      if (opacity <= 0) {
        clearInterval(fadeInterval);
        element.style.display = 'none';
      } else {
        opacity -= 0.1;
        element.style.opacity = opacity;
      }
    }, 50);
  }

const changeActive = (selectedIndex) => { 
	var locationCards = document.querySelectorAll('.location-card');
	// Oculta el elemento con la clase 'active' actual
    var activeElement = document.querySelector('.location-card.active');
    if (activeElement) {
      activeElement.classList.remove('active');
    }
    var selectedElement = locationCards[selectedIndex];
    if (selectedElement) {
      selectedElement.classList.add('active');
    }
}

options.forEach((option) => {
	option.addEventListener('click', () => {
		console.log(option.dataset.value)
		let markerIndex = option.dataset.value;
		spanElement.value = option.innerHTML
		focusMarker(markerIndex)
		changeActive(markerIndex)
	})
})