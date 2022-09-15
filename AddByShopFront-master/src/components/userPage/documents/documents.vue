<template>
  <empty-document>
  </empty-document>
  <section>
    <document-item></document-item>
  </section>
</template>
<script>
import EmptyDocument from "@/components/userPage/documents/emptyDocument";
import DocumentItem from "@/components/userPage/documents/documentItem";

export default {
  components: {DocumentItem, EmptyDocument}
}
</script>