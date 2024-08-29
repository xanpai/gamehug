
<div class="mb-4">
    <template x-for="(subtitle, index) in subtitles" :key="index">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6">
            <input type="hidden" x-bind:name="`subtitle[${index}][id]`" x-model="subtitle.id">

            <div class="col-span-3">
                <div class="mb-4">
                    <x-form.select name="subtitle[][scene_id]" x-model="subtitle.scene_id" x-bind:name="`subtitle[${index}][scene_id]`">
                        <option>{{__('Choose')}}</option>
                        @foreach($scenes as $scene)
                            <option data-text="{{$scene->code}}" value="{{$scene->id}}"
                                    @if(isset($listing->scene_id) AND $listing->scene_id == $scene->id) selected @endif>{{$scene->name}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <div class="col-span-7">
                <div class="mb-4">
                    <x-form.file type="file" name="subtitle[][link]"
                                  placeholder="{{__('http://')}}" x-model="subtitle.link" x-bind:name="`subtitle[${index}][link]`"/>
                </div>
            </div>
            <div class="col-span-2">
                <x-form.secondary type="button" @click="removeSubField(index,subtitle.id)"
                                  class="w-full">{{__('Remove')}}</x-form.secondary>
            </div>
        </div>
    </template>
    <x-form.secondary type="button" @click="addSubField()"
                      class="w-full">{{__('Add new')}}</x-form.secondary>
</div>
