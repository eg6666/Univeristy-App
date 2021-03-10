<template>
  <preloader v-if="loading"/>
  <div class="editor__wrapper" v-else>
    <h1>Modifiko një njoftim</h1>
    <br/>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Ngarko një imazh</span>
    </div>
    <div>
      <input type="file" @change="uploadFile" class="custom-file-input" id="inputGroupFile01">
      <label class="custom-file-label" for="inputGroupFile01">{{message}}</label>
    </div>
    </div>
    <b-input v-model="title" style="border-radius: 5px" placeholder="Titulli"/>
    <hr/>
    <div class="editor">
        <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
        <div class="menubar">

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.bold() }"
            @click="commands.bold"
            >
            <icon name="bold" />
            </button>

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.italic() }"
            @click="commands.italic"
            >
            <icon name="italic" />
            </button>

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.strike() }"
            @click="commands.strike"
            >
            <icon name="strike" />
            </button>

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.underline() }"
            @click="commands.underline"
            >
            <icon name="underline" />
            </button>

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.code() }"
            @click="commands.code"
            >
            <icon name="code" />
            </button>

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.paragraph() }"
            @click="commands.paragraph"
            >
            <icon name="paragraph" />
            </button>

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.heading({ level: 1 }) }"
            @click="commands.heading({ level: 1 })"
            >
            H1
            </button>

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.heading({ level: 2 }) }"
            @click="commands.heading({ level: 2 })"
            >
            H2
            </button>

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.heading({ level: 3 }) }"
            @click="commands.heading({ level: 3 })"
            >
            H3
            </button>

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.bullet_list() }"
            @click="commands.bullet_list"
            >
            <icon name="ul" />
            </button>

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.ordered_list() }"
            @click="commands.ordered_list"
            >
            <icon name="ol" />
            </button>

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.blockquote() }"
            @click="commands.blockquote"
            >
            <icon name="quote" />
            </button>

            <button
            class="menubar__button"
            :class="{ 'is-active': isActive.code_block() }"
            @click="commands.code_block"
            >
            <icon name="code" />
            </button>

            <button
            class="menubar__button"
            @click="commands.horizontal_rule"
            >
            <icon name="hr" />
            </button>

            <button
            class="menubar__button"
            @click="commands.undo"
            >
            <icon name="undo" />
            </button>

            <button
            class="menubar__button"
            @click="commands.redo"
            >
            <icon name="redo" />
            </button>

        </div>
        </editor-menu-bar>

        <editor-content class="editor__content" :editor="editor" />
    </div>
    <b-button @click="updateNotification" block style="margin-top: 1em">Ndrysho Njoftimin</b-button>
  </div>
</template>

<script>
import Icon from '@/components/Icon/Icon.vue'
import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
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
  Italic,
  Link,
  Strike,
  Underline,
  History,
} from 'tiptap-extensions'
import "tiptap/src/style.css"
import Preloader from './Preloader.vue'

export default {
  name: "NotificationUpdate",
  components: {
    EditorContent,
    EditorMenuBar,
    Icon,
    Preloader,
  },
  data() {
    Preloader
    return {
      title: '',
      loading: true,
      html: '',
      json: '',
      file_path: '',
      message: 'Zgjidh një skedar të ri',
      editor: new Editor({
        extensions: [
          new Blockquote(),
          new BulletList(),
          new CodeBlock(),
          new HardBreak(),
          new Heading({ levels: [1, 2, 3] }),
          new HorizontalRule(),
          new ListItem(),
          new OrderedList(),
          new TodoItem(),
          new TodoList(),
          new Link(),
          new Bold(),
          new Code(),
          new Italic(),
          new Strike(),
          new Underline(),
          new History(),
        ],
        content: `Shkruani një njoftim...`,
        onUpdate: ({ getJSON, getHTML }) => {
          this.json = getJSON()
          this.html = getHTML()
        },
      }),
    }
  },
  async created() {
    try {
        this.loading = true
        const res = await this.$api.blog.getNotificationByID(this.$route.params.id)
        this.editor.setContent(res.data.content, true)
        this.title = res.data.title
        this.loading = false
        this.file_path = res.data.file_path
    } catch (err) {
        this.$notify({
                    group: "error",
                    title: "Error",
                    text: `Pati një problem. Ju lutem provoni përsëri.`,
                    type: "error",
                })
    }
  },
  beforeDestroy() {
    this.editor.destroy()
  },
  methods: {
      async updateNotification() {
          try {
            const payload = {
                title: this.title,
                content: this.html,
                file_path: this.file_path,
            }

            await this.$api.blog.updateNotification(this.$route.params.id, payload)
            this.$router.push({name: 'FTINotifications'})
          } catch (err) {
            this.$notify({
                    group: "error",
                    title: "Error",
                    text: `Pati një problem. Ju lutem provoni përsëri.`,
                    type: "error",
                })
          }
      },
      async uploadFile(e) {
          const files = e.target.files;
          const data = new FormData();
          data.append("file", files[0]);
          data.append("upload_preset", "ignisapp");
          try {
            this.message = "Duke ngarkuar..."
            const res = await fetch(
              "https://api.cloudinary.com/v1_1/ignis/auto/upload",
              {
                method: "POST",
                body: data
              }
            );

            const file = await res.json();
            this.file_path = file.secure_url;
            this.message = "Skedari u ngarkua me sukses!"
      } catch (err) {
        this.$notify({
          group: "error",
          title: "Error",
          text: `Pati një problem. Ju lutem provoni përsëri.`,
          type: "error",
        })
      }
    }
  }
}
</script>

<style lang="scss">
.editor__wrapper {
    width: 50em;
    margin: 2em auto;
}
</style>