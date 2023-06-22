import { Notify } from 'quasar';

/**
 * Creates a notification using the Quasar Notify component
 * @param title - The title (string) of the error message (optional)
 * @param description - The error message (string or array of strings)
 * or a map of error messages with their respective keys (optional)
 * @param type - The type of the notification to display.
 * The acceptable values are: positive, negative, warning, info and ongoing
 * @param additionalMessage - Additional notification message (optional)
 * that is returned by the api response
 * @returns void
 */
const notificationSystem = (
  title: string | undefined,
  description: string | undefined,
  type: 'positive' | 'negative' | 'warning' | 'info' | 'ongoing',
  additionalMessage?: { [key: string]: string } | undefined,
) =>
  Notify.create({
    html: true,
    icon: displayNotificationIcon(type),
    message: displayNotificationMessage(title, description, type, additionalMessage),
    position: 'bottom',
    progress: true,
    textColor: displayNotificationColor(type),
    type: type,
    timeout: type !== 'positive' && type !== 'info' ? 10000 : 5000,
    classes: type !== 'positive' && type !== 'info' ? 'q-notification-error' : ''
  })

  /**
   * Returns the icon to display for the given notification type
   * @param type - The type of the notification (string)
   * @returns string
   */
  function displayNotificationIcon(type: string): string {
    switch (type) {
      case 'positive':
        return 'done';
      case 'info':
        return 'info';
      case 'warning':
        return 'warning';
      case 'negative':
        return 'error';
      default:
        return '';
    }
  }

  /**
   * Returns the message to display for the given error title and description
   * @param title - The title (string) of the error message (optional)
   * @param description - The error message (string or array of strings)
   * or a map of error messages with their respective keys (optional)
   * @param type - The type of the notification to display.
   * The acceptable values are: positive, negative, warning, info and ongoing
   * @param additionalMessage - Additional message information (string)
   * that is returned by the backend (optional)
   * @returns string
   */
  function displayNotificationMessage(
    title: string | undefined,
    description: { [key: string]: string } | string | undefined,
    type: 'positive' | 'negative' | 'warning' | 'info' | 'ongoing',
    additionalMessage?: { [key: string]: string } | undefined,
  ): string {
    if (description && typeof description !== 'string') {
      let listItems = '';
      for (const key in description) {
        listItems += `<p class="q-mb-none">${description[key][0].replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>`;
      }
      return `
        <p class="q-mb-none">${title}</p>
        ${listItems}
      `;
    } else if (typeof description === 'string') {
      const commonMessage = `
        <p class="q-mb-none">${title}! ${description}!</p>
        <p class="q-mb-none">${
          additionalMessage && additionalMessage !== undefined &&
          (additionalMessage.hasOwnProperty('description') || additionalMessage.hasOwnProperty('message'))
            ? (additionalMessage.description || additionalMessage.message) :
            'There was a problem in processing your request!'
        }</p>
      `;
      if (type === 'positive' || type === 'info') {
        return commonMessage;
      } else {
        return commonMessage + `
          <p class="q-mb-none">Please try again and if the problem persist contact the administrator!</p>
        `;
      }
    } else if (title) {
      return `
        <p class="q-mb-none">${title}</p>
      `;
    } else {
      return 'Something went wrong! Please try again!';
    }
  }

  /**
   * Returns the color to use for the text of the notification based on the notification type
   * @param type - The type of the notification (string)
   * @returns string
   */
  function displayNotificationColor(type: string): string {
    switch (type) {
      case 'positive':
      case 'warning':
      case 'info':
        return 'black';
      case 'negative':
        return 'white';
      default:
        return '';
    }
  }

export { notificationSystem };
