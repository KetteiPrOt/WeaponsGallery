<footer
    class="
        pb-6
        w-10/12 mx-auto
        flex flex-wrap
        justify-center
    "
>
    {{-- Weapons Links --}}
    <div>
        <x-footer-link :route="route('weapons.index', 'ar')">
            AR
        </x-footer-link>
        <x-footer-link :route="route('weapons.index', 'smg')">
            SMG
        </x-footer-link> 
        <x-footer-link :route="route('weapons.index', 'sg')">
            SG
        </x-footer-link>
        <x-footer-link :route="route('weapons.index', 'rf')">
            RF
        </x-footer-link> 
        <x-footer-link :route="route('weapons.index', 'hg')">
            HG
        </x-footer-link>
    </div>
    {{-- Admin and Information Links --}}
    <div>
        <x-footer-link :route="route('contact')">
            Contacto
        </x-footer-link>
        <x-footer-link :route="route('about')">
            Acerca de
        </x-footer-link>
    
        @auth
            <x-footer-link :route="route('dashboard')">
                Panel
            </x-footer-link>
            <x-footer-link :route="route('profile.edit')">
                Perfil
            </x-footer-link>
        @else
            <x-footer-link :route="route('login')">
                Administrar
            </x-footer-link>
        @endauth
    </div>
</footer>