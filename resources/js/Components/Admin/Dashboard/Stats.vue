<template>
    <div>
        <h3 class="ml-2 text-base font-semibold text-white">Last 30 days</h3>
        <dl
            class="inset-ring inset-ring-white/10 mt-5 grid grid-cols-1 divide-white/10 overflow-hidden rounded-lg bg-gray-800/75 md:grid-cols-3 md:divide-x md:divide-y-0"
        >
            <div
                v-for="stat in stats"
                :key="stat.name"
                class="px-4 py-5 sm:p-6"
            >
                <dt class="text-base font-normal text-gray-100">
                    {{ stat.name }}
                </dt>
                <dd
                    class="mt-1 flex items-baseline justify-between md:block lg:flex"
                >
                    <div
                        class="flex items-baseline text-2xl font-semibold text-indigo-400"
                    >
                        {{ stat.stat }}
                        <span class="ml-2 text-sm font-medium text-gray-400"
                            >from {{ stat.previousStat }}</span
                        >
                    </div>

                    <div
                        v-if="stat.change !== null"
                        :class="[
                            hasIncreased(stat)
                                ? 'bg-green-400/10 text-green-400'
                                : 'bg-red-400/10 text-red-400',
                            'inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0',
                        ]"
                    >
                        <ArrowUpIcon
                            v-if="hasIncreased(stat)"
                            class="-ml-1 mr-0.5 size-5 shrink-0 self-center text-green-400"
                            aria-hidden="true"
                        />
                        <ArrowDownIcon
                            v-else
                            class="-ml-1 mr-0.5 size-5 shrink-0 self-center text-red-400"
                            aria-hidden="true"
                        />
                        <span class="sr-only">
                            {{ hasIncreased(stat) ? 'Increased' : 'Decreased' }}
                            by
                        </span>
                        {{ stat.change }}
                    </div>
                </dd>
            </div>
        </dl>
    </div>
</template>

<script setup lang="ts">
import { ChangeTypeEnum } from '@/Types/Admin/Enums/ChangeTypeEnum';
import { StatsInterface } from '@/Types/Admin/Interfaces/StatsInterface';
import { ArrowDownIcon, ArrowUpIcon } from '@heroicons/vue/20/solid';

defineProps<{
    stats: StatsInterface[];
}>();

const hasIncreased = (stat: StatsInterface): boolean =>
    stat.changeType === ChangeTypeEnum.INCREASE;
</script>
