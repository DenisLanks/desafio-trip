<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   <b-form-group
                    id="fieldset-1"
                    description="Let us know your name."
                    label="Enter your name"
                    label-for="input-1"
                    valid-feedback="Thank you!"
                    :invalid-feedback="invalidFeedback"
                    :state="state"
                    >
                        <b-form-select v-model="selected" :options="options"></b-form-select>
                    </b-form-group>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
