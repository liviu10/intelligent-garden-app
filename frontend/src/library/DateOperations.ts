import { Ref, ref } from 'vue';

enum DateType {
  'en-US',
  'ro-RO',
}

enum DateOption {
  'full_date_and_time',
  'only_date',
}

/**
 * This function will format the date based on the date type and date options.
 */
function dateFormat(
  date: string | null,
  localDate: string,
  localDateOption: string
): string {
  if (typeof date === 'string') {
    if (
      typeof localDate === 'string' &&
      Object.values(DateType).includes(localDate) &&
      Object.values(DateOption).includes(localDateOption)
    ) {
      const dateOptions: Ref<{
        day: 'numeric' | '2-digit' | undefined;
        month: 'numeric' | '2-digit' | undefined;
        year: 'numeric' | '2-digit' | undefined;
        hour: 'numeric' | '2-digit' | undefined;
        minute: 'numeric' | '2-digit' | undefined;
      }> = ref({
        day: undefined,
        month: undefined,
        year: undefined,
        hour: undefined,
        minute: undefined,
      });
      if (localDateOption === 'full_date_and_time') {
        dateOptions.value = {
          day: 'numeric',
          month: 'numeric',
          year: 'numeric',
          hour: 'numeric',
          minute: 'numeric',
        };
      } else if (localDateOption === 'only_date') {
        dateOptions.value = {
          day: 'numeric',
          month: 'numeric',
          year: 'numeric',
          hour: undefined,
          minute: undefined,
        };
      }
      return new Date(date).toLocaleDateString(localDate, dateOptions.value);
    } else {
      console.log(
        'You did not specify the local date or local date options! The default date format will be used!'
      );
      const defaultLocaleDate = 'en-US';
      return new Date(date).toLocaleDateString(defaultLocaleDate, {
        day: 'numeric',
        month: 'numeric',
        year: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
      });
    }
  } else {
    return '—';
  }
}

/**
 * This function will display the name of the day.
 */
function displayDayName(date: string): number | string {
  const dayNames: string[] = [
    'Sunday',
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday',
  ];
  if (typeof date === 'string') {
    return dayNames[new Date(date).getDay()];
  } else {
    return '—';
  }
}

/**
 * This function will display the name of the month.
 */
function displayMonthName(date: string): string {
  const monthNames: string[] = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December',
  ];
  if (typeof date === 'string') {
    return monthNames[new Date(date).getMonth()];
  } else {
    return '—';
  }
}

/**
 * This function will display the full year.
 */
function displayFullYear(date: string): number | string {
  if (typeof date === 'string') {
    return new Date(date).getFullYear();
  } else {
    return '—';
  }
}

export { dateFormat, displayDayName, displayMonthName, displayFullYear };
