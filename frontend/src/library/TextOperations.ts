/**
 * This function will normalize a given string by making the first letter
 * uppercase and replace any special characters (eg: @, -, _ etc) with a space.
 */
function displayLabel(label: string | number): string {
  if (typeof label === 'string') {
    return (
      label.charAt(0).toUpperCase() + label.slice(1).replace(/[^a-zA-Z ]/g, ' ')
    );
  } 
  return String(label);
}

/**
 * This function will set the correct label text color in order to
 * increase the contrast for a better accessability.
 */
function displayLabelColor(
  labelColor: string | undefined,
  labelTextColor: string | undefined
): string {
  if (labelColor === undefined && labelTextColor === undefined) {
    return 'white';
  } else {
    if (
      labelColor === 'secondary' ||
      labelColor === 'positive' ||
      labelColor === 'info' ||
      labelColor === 'warning'
    ) {
      return 'black';
    } else {
      return 'white';
    }
  }
}

export { displayLabel, displayLabelColor };
