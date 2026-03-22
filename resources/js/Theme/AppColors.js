import {palette} from '@primeuix/themes';
// DEFINIR DESING SYSTEM DE CORES
export const colors = {
    /* GREEN */
    green: {
        700:'#015924',
        500:'#03983E',
        300:'#04D361',
        100:'#93D6B1',
    },
    /* BEGE */
    bege: {
        700:'#946C4B',
        500:'#D1A57A',
        300:'#F6D1A8',
        100:'#F8E3CB',
    },
    /* ORANGE */
    orange:{
        700:'#9B2908',
        500:'#EB3D0B',
        300:'#EF5F08',
        100:'#E7AC88',
    },
    /* RED */
    red: {
        700:'#660404',
        500:'#E20505',
        300:'#F44336',
        100:'#F3AAA4',
    },
    /* YELLOW */
    yellow: {
        700:'#BF9500',
        500:'#FFC700',
        300:'#FFF500',
        100:'#FFE69C',
    },
    /* BLUE */
    blue:{
        700:'#0C0626',
        500:'#140750',
        300:'#1F7BF2',
        100:'#A1C2EC',
    },
    /* PURPLE */
    purple:{
        700:'#21054E',
        500:'#450CA0',
        300:'#6610F2',
        100:'#AB85E8',
    },
    /* CYAN */
    cyan:{
        700:'#055160',
        500:'#0DCAF0',
        300:'#6EDFF6',
        100:'#BEEFF9',
    },
    /* BROWN */
    brown: {
        700:'#472302',
        500:'#9C4D03',
        300:'#DF8C3E',
        100:'#F8D9BD',
    },
    /* DARK */
    dark: {
        700:'#181818',
        500:'#272727',
        300:'#454545',
    },
    /* GRAY */
    gray:{
        700:'#969696',
        500:'#AAAAAA',
        300:'#CCCCCC',
    },
    light:{
        300:'#E8EDFA',
        100:'#FFFFFF',
    }
}

//PALETA DE CORES HARPIA
export const appColors = {
   primary: palette(colors.green[300]),
   secondary: palette(colors.blue[500]),
   surface: palette(colors.light[300]),
}

// EXPORTAR PALETAS PRONTAS
export const palettes = {
    primary: palette(colors.green[300]),
    secondary: palette(colors.blue[500]),
    green: palette(colors.green[300]),
    orange: palette(colors.orange[300]),
    red: palette(colors.red[300]),
    yellow: palette(colors.yellow[300]),
    blue: palette(colors.blue[300]),
    purple: palette(colors.purple[300]),
    cyan: palette(colors.cyan[300]),
    brown: palette(colors.brown[300])
};