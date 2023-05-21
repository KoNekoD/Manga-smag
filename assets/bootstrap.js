import {startStimulusApp} from '@symfony/stimulus-bridge';
import carousel_controller from "./controllers/carousel_controller";
import mini_carousel_controller from "./controllers/mini_carousel_controller";
import mini_mini_carousel_controller from "./controllers/mini_mini_carousel_controller";

// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));

// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

// Sliders
// https://www.stimulus-components.com/docs/stimulus-carousel/
app.register('carousel_mini', mini_carousel_controller)
app.register('carousel_mini_mini', mini_mini_carousel_controller)
app.register('carousel_big', carousel_controller)

