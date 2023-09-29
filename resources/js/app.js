import './bootstrap';

import Alpine from 'alpinejs';

// --- --- Tailwind Elements Plugin
import {
    Carousel,
    Collapse,
    Modal,
    Ripple,
    initTE,
} from "tw-elements";

// Initialization for ES Users
initTE({ Carousel, Collapse, Modal, Ripple });
// --- --- End Tailwind Elements Plugin

window.Alpine = Alpine;

Alpine.start();
