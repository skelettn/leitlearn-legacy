import { initSidebar } from './modules/sidebar.js';
import { initModals } from './modules/modals.js';
import { initFlashcards } from "./modules/flashcards.js";
import { initDecks } from "./modules/decks.js";
import { initSearch } from "./modules/search.js";
import { initAi } from "./modules/ai.js";
import { initUsers } from "./modules/users.js";
import { initKeywords } from "./modules/keywords.js";
import { initEventHandlers } from "./modules/eventHandler.js";

$(document).ready(function () {
    initSidebar();
    initModals();
    initDecks();
    initAi();
    initFlashcards();
    initUsers();
    initKeywords();
    initEventHandlers();
});
