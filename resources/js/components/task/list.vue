<template>
  <div>
    <div v-if="!tasks.length" class="alert alert-light">
      Add your first task
    </div>
    <ul v-else class="list-group">
      <li class="list-group-item" v-for="(task, i) in tasks" :key="i">
        <task-single
          :task="task"
          :tasks="tasks"
          v-on:taskupdated="$emit('updateTasksList')"
        />
      </li>
    </ul>
  </div>
</template>

<script>
import taskSingle from "./single.vue";
export default {
  props: ["tasks"],
  components: { taskSingle },
};
</script>
