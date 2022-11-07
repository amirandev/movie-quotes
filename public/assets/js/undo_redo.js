class UndoRedo {
    constructor(selectors) {
        this.stack = [];
        this.currentIndex = null;
        this.editor = document.querySelector(selectors.editor);
        this.undoButton = document.querySelector(selectors.undo);
        this.redoButton = document.querySelector(selectors.redo);
    }

    undo = () => {
        if (this.currentIndex == null) this.currentIndex = this.stack.length - 1;
        if ((this.currentIndex - 1) < 0) return false;
        this.currentIndex = this.currentIndex - 1;
        this.editor.value = this.stack[this.currentIndex];
    };

    redo = () => {
        if (this.currentIndex == null) this.currentIndex = this.stack.length - 1;
        if ((this.currentIndex + 1) >= this.stack.length) return false;
        this.currentIndex = this.currentIndex + 1;
        this.editor.value = this.stack[this.currentIndex];
    };

    pushValue = () => {
        if (this.editor.value.length % 2 == 0) {
            this.stack.push(this.editor.value);
        }
    }

    start = () => {
        this.editor.addEventListener("input", () => this.pushValue());
        this.undoButton.addEventListener("click", () => this.undo());
        this.redoButton.addEventListener("click", () => this.redo());
    };
}

new UndoRedo({
    'editor': '#editor',
    'undo': '#undo',
    'redo': '#redo'
}).start();