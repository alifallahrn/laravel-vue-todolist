<template>
  <ul class="list-group">
    <li class="list-group-item" v-for="(task, i) in tasks" :key="i">
      <task-single :task="task" v-on:taskupdated="$emit('updateTasksList')" />
    </li>
  </ul>
</template>

<script>
import taskSingle from "./single.vue";
export default {
  props: ["tasks"],
  components: { taskSingle },
};
</script>
