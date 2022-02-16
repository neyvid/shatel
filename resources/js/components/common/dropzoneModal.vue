<template>
    <v-dialog v-model="imageModal"
              max-width="360px"
    >
        <v-card>
            <v-card-title>عکس خود را اپلود کنین</v-card-title>

            <vue-dropzone id="dropzone"
                          :options="dropzoneOptions"
                          @vdropzone-success="upload"
                          ref="dropzone"
            ></vue-dropzone>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn @click="imageModal = false"
                >
                    بستن
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import VueDropzone from "vue2-dropzone";

export default {
    name: "dropzoneModal",
    components: {
        VueDropzone,
    },
    data() {
        return {
            imageModal: false,
            imageCommand: false,
            dropzoneOptions: {
                url: '/api/user/upload',
                maxFiles: 1,
                headers: {
                    'X-CSRF-TOKEN': window.csrf_token
                }
            },
        }
    },
    methods: {
        showModal(imageCommand) {
            this.imageModal = true;
            this.imageCommand = imageCommand
        },
        upload(file, response) {
            const data = {
                imageCommand: this.imageCommand,
                attrs: {
                    src: response.data
                }
            }
            this.$emit('image', data);

            this.imageModal = false;
            this.imageCommand=null;
            this.$refs.dropzone.removeFile(file);
        }
    }
}
</script>

<style scoped>

</style>
