/**
 * This function will format any given number to 2 decimals.
 */
function roundNumber(number: number): number | string {
  if (typeof number === 'number') {
    return Math.round(number * 100) / 100;
  } else {
    return '—';
  }
}

export { roundNumber };
