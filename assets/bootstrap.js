import {startStimulusApp} from '@symfony/stimulus-bridge';
import carousel_controller from "./controllers/carousel_controller";
import mini_carousel_controller from "./controllers/mini_carousel_controller";
import {Alert, Autosave, Dropdown, Modal, Popover, Slideover, Tabs, Toggle} from "tailwindcss-stimulus-components"

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
app.register('carousel', mini_carousel_controller)
app.register('carousel_big', carousel_controller)

app.register('alert', Alert)
app.register('autosave', Autosave)
app.register('dropdown', Dropdown)
app.register('modal', Modal)
app.register('tabs', Tabs)
app.register('popover', Popover)
app.register('toggle', Toggle)
app.register('slideover', Slideover)
