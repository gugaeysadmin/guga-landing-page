
<div {{ $attributes->merge(['class'=> 'grid grid-cols-1 md:grid-cols-3 gap-20 py-6 sm:px-4 md:px-12 lg:px-32 bg-[linear-gradient(120deg,rgba(255,255,255,0)_0%,rgba(163,186,221,1)_100%)]']) }}>
    <!-- Informacion de la empresa -->
    <div class="block" >
        <img src="{{ asset('img/LogoGUGAChico.png') }}" class="my-4" alt="" />
        <p class="mt-2 mb-4 pr-12">
        Somos una empresa comprometida con ofrecer a todos los médicos
        material de la más alta calidad.
        </p>
        <!-- Iconos de contacto de la emporesa -->
        <a class="bi bi-whatsapp mr-2" href="https://api.whatsapp.com/send?phone=5567099766"></a>
        <a class="bi bi-facebook mr-2" href="https://www.facebook.com/gugaeys/" target="_blank"></a>
        <a class="bi bi-linkedin" href="https://www.linkedin.com/company/guga-equipos-y-servicios-sa-de-cv" target="_blank"></a>
    </div>
    <div  class="block ga">
        <!-- Seccion con la direccion, telefono y correo -->
        <p class="bi bi-geo-alt mt-8">
            Jazmines #34 Col. Granjas San Pablo C.P. 54930 Tultitlan Estado de
            México México
        </p>
        <p class="bi bi-phone mt-4">
            <a href="tel:+5515430499" class="hover:font-semibold">
                55 1543 0499
            </a>
        </p>
        <p class="bi bi-phone mt-4">
            <a href="tel:+5558796644" class="hover:font-semibold">
                55 5879 6644
            </a>
        </p>
        <p class="bi bi-envelope mt-4">
            <a href="mailto:info@gugaequiposyservicios.com.mx" class="hover:font-semibold">
                info@gugaequiposyservicios.com.mx
            </a>
        </p>
    </div>
    <div  class="block">
        <!-- iframe que consume la api de google para mostrar en mapa la ubicacion -->
        <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d330.64515789098084!2d-99.082913472065!3d19.662795710207423!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f3286c8db41d%3A0xbb7218bc15b13646!2sGUGA%20EQUIPOS%20Y%20SERVICIOS%20SA%20DE%20CV!5e0!3m2!1ses-419!2smx!4v1694476453664!5m2!1ses-419!2smx"
        width="100%"
        height="100%"
        style="border: 0; border-radius: 25px; box-shadow: 0px 12px 20px -10px rgba(0, 0, 0, 0.25);"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
</div>