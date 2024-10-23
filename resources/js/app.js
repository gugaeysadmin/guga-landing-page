import './bootstrap';
import Alpine from 'alpinejs';

import { Tooltip,Carousel, initTWE } from "tw-elements";

initTWE({ Tooltip, Carousel });

window.Alpine = Alpine;

Alpine.start();
