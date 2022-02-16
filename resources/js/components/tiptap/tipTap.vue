<template>
    <v-container>
        <v-row>
            <v-col>
                <editor-menu-bar class="menu-bar" :editor="editor" v-slot="{ commands, isActive }">
                    <div>

                        <v-btn text icon v-for="btn in editorMenuBar" :key="btn.icon"
                               :class="{ 'is-active': isActive[btn.active](btn.context)}"
                               @click="commands[btn.command](btn.context)"
                        >
                            <v-icon>mdi-{{ btn.icon }}</v-icon>
                        </v-btn>

                        <v-btn text icon
                               :class="{ 'is-active': isActive.image()}"
                               @click.stop="openModal(commands.image)"
                        >
                            <v-icon>mdi-image-plus</v-icon>
                        </v-btn>


                    </div>
                </editor-menu-bar>
            </v-col>

        </v-row>
        <v-row>
            <v-col>
                <editor-content class="editor-box " :editor="editor"/>

            </v-col>

        <dropzone-modal ref="dropzoneModal" @image="uploadImage"></dropzone-modal>
        </v-row>
    </v-container>
</template>

<script>
import {Editor, EditorContent, EditorFloatingMenu, EditorMenuBar} from "tiptap";
import {
    Blockquote,
    CodeBlock,
    HardBreak,
    Heading,
    HorizontalRule,
    OrderedList,
    BulletList,
    ListItem,
    TodoItem,
    TodoList,
    Bold,
    Code,
    Image,
    Italic,
    Link,
    Strike,
    Underline,
    History,
    Placeholder
} from "tiptap-extensions";
import DropzoneModal from "../common/dropzoneModal";

export default {
    name: "tipTap",
    components: {
        DropzoneModal,
        EditorContent,
        EditorMenuBar,
        EditorFloatingMenu,

    },
    data() {

        return {

            editorMenuBar: [
                {
                    active: 'bold',
                    command: 'bold',
                    icon: 'format-bold',
                    context: {},
                },
                {
                    active: 'italic',
                    command: 'italic',
                    icon: 'format-italic',
                    context: {},
                },
                {
                    active: 'underline',
                    command: 'underline',
                    icon: 'format-underline',
                    context: {},
                },
                {
                    active: 'heading',
                    command: 'heading',
                    icon: 'format-header-1',
                    context: {level: 1},
                },
                {
                    active: 'heading',
                    command: 'heading',
                    icon: 'format-header-2',
                    context: {level: 2},
                },
                {
                    active: 'heading',
                    command: 'heading',
                    icon: 'format-header-3',
                    context: {level: 3},
                },


            ],

            editor: new Editor({
                extensions: [
                    new Blockquote(),
                    new CodeBlock(),
                    new HardBreak(),
                    new HorizontalRule(),
                    new OrderedList(),
                    new BulletList(),
                    new ListItem(),
                    new TodoItem(),
                    new TodoList(),
                    new Bold(),
                    new Code(),
                    new Image(),
                    new Italic(),
                    new Link(),
                    new Strike(),
                    new Underline(),
                    new History(),
                    new Heading({level: [1, 2, 3]}),
                    new Placeholder({
                        emptyEditorClass: 'is-editor-empty',
                        emptyNodeClass: 'is-empty',
                        emptyNodeText: 'هرچیزی که دوست داری بنویس...',
                        showOnlyWhenEditable: true,
                        showOnlyCurrent: true,
                    })
                ],
                content: this.value,
                onUpdate: ({getHTML}) => {
                    this.$emit('input', getHTML());
                    // send the content to an API here
                },
                onSelectionUpdate: ({editor}) => {
                    this.$emit(editor);
                    // send the content to an API here
                },



            }),

        }
    },
    props: {
        value: {
            type: String,
            default: ''
        }
    },
    methods: {
        openModal(imageCommand){
            this.$refs.dropzoneModal.showModal(imageCommand);
        },
        uploadImage(data){
            data.imageCommand(data.attrs);
        }
    },
    beforeDestroy() {
        this.editor.destroy();
    }

}
</script>

<style lang="scss">
.editor {
    position: relative;
    margin: 0;

    &__floating-menu {
        position: absolute;
        z-index: 1;
        margin-top: -0.25rem;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.2s, visibility 0.2s;

        &.is-active {
            opacity: 1;
            visibility: visible;
        }
    }
}

.menu-bar {
    display: flex;
    background-color: #ffffff;
    padding: 0.2rem;
    border-radius: 0.5rem;

    button {
        border: none;
        background: none;
        color: #FFF;
        font-size: 0.85rem;
        font-weight: 500;
        padding: 0 0.2rem;
        opacity: 0.7;

        &:hover,
        {
            opacity: 1;
        }

        &.is-active,
        {
            opacity: 1;
            border: 1px solid grey;
        }
    }
}

.editor-box p.is-editor-empty:first-child::before {
    content: attr(data-empty-text);
    float: right;
    color: #aaa;
    pointer-events: none;
    height: 0;
    font-style: italic;
}

.ProseMirror {
    > * + * {
        margin-top: 0.75em;
    }

    img {
        max-width: 100%;
        height: auto;

        &.ProseMirror-selectednode {
            outline: 3px solid #68CEF8;
        }
    }
}
</style>
