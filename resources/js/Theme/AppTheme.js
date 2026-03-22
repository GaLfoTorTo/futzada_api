import { computed, ref } from "vue";
import Aura from '@primeuix/themes/aura';
import { definePreset } from '@primeuix/themes';
import { appColors, colors } from "./AppColors";

const appState = ref({
   primary: "green",
   surface: null,
   darkMode: false,
   sidebarCollapsed: false
});

//PRESET DE COMPONENTES
const appComponents = {
   //CONFIGURAÇÕES DE TOOLBAR/NAVBAR
   toolbar: {
      colorScheme:{
         light:{
            root:{
               background: '#fff',
               color: '{slate.600}',
               borderRadius: '0',
               padding: '0.9rem'
            }
         },
         dark:{
            root:{
               background: '{secondary.500}',
               color: '#fff',
               borderRadius: '0',
               padding: '0.9rem'
            }
         }
      }
   },
   breadcrumb: {
      colorScheme:{
         light: {
            root:{
               background: '{surface.background}',
            },
            item:{
               color: '{text.muted.color}',
            }
         },
         dark: {
            root:{
               background: '{surface.background}',
            },
            item:{
               color: '{slate.50}',
            }
         }
      }
   },
   datatable: {
      colorScheme:{
         light: {
            row: {
               stripedBackground: '{surface.50}'
            },
            filter: {
               overlayPopover: {
                  background: '{overlay.popover.background}',
               }
            },
            headerCell: {
               hoverBackground: '{content.hover.background}',
            }
         },
         dark: {
            row: {
               stripedBackground: '{zinc.800}'
            },
            filter: {
               overlayPopover: {
                  background: '{content.background}',
               }
            },
            headerCell: {
               hoverBackground: '{zinc.800}',
            }
         }
      }
   },
   inputtext:{
      colorScheme:{
         light: {
            background: '{content.background}',
            filledBackground: '{form.field.filled.background}',
         },
         dark: {
            background: '{body.background}',
            filledBackground: '{zinc.900}',
            filledHoverBackground: '{zinc.800}',
         }
      }
   },
   textarea:{
      colorScheme:{
         light: {
            background: '{content.background}',
            filledBackground: '{form.field.filled.background}',
         },
         dark: {
            background: '{body.background}',
            filledBackground: '{zinc.900}',
            filledHoverBackground: '{zinc.800}',
         }
      }
   },
   select:{
      colorScheme:{
         light: {
            background: '{content.background}',
            disabledBackground: '{form.field.filled.background}',
         },
         dark: {
            background: '{body.background}',
            disabledBackground: '{zinc.900}',
         }
      }
   },
   multiselect:{
      colorScheme:{
         light: {
            background: '{content.background}',
            disabledBackground: '{form.field.filled.background}',
         },
         dark: {
            background: '{body.background}',
            disabledBackground: '{zinc.900}',
         }
      }
   },
   dialog:{
      colorScheme:{
         light: {
            background: '{content.background}',
         },
         dark: {
            background: '{content.background}',
         }
      }
   },
   togglebutton:{
      colorScheme:{
         light: {
            root: {
               background: '{body.background}',
               checkedBackground: '{primary.300}',
               hoverBackground: '{primary.100}',
               borderColor: '{surface.100}',
               color: '{surface.500}',
               hoverColor: '{surface.0}',
               checkedColor: '{surface.0}',
               checkedBorderColor: '{surface.100}',
               disabledBackground: '{body.background}',
               disabledColor: '{surface.400}',
            },
            content: {
               checkedBackground: '{primary.500}'
            },
            icon: {
               color: '{surface.500}',
               hoverColor: '{surface.0}',
               checkedColor: '{surface.0}',
               disabledColor: '{surface.400}',
            }
         },
         dark: {
            root: {
               background: '{body.background}',
               checkedBackground: '{primary.300}',
               hoverBackground: '{primary.100}',
               borderColor: '{surface.100}',
               color: '{surface.0}',
               hoverColor: '{surface.0}',
               checkedColor: '{surface.0}',
               checkedBorderColor: '{surface.100}',
               disabledBackground: '{body.background}',
               disabledColor: '{surface.500}',
            },
            content: {
               checkedBackground: '{primary.500}'
            },
            icon: {
               color: '{surface.0}',
               hoverColor: '{surface.0}',
               checkedColor: '{surface.0}',
               disabledColor: '{surface.500}',
            }
         }
      }
   },
   button:{
      colorScheme: {
         light: {
            root: {
               primary: {
                  background: '{secondary.color}',
                  hoverBackground: '{primary.color}',
                  activeBackground: '{primary.active.color}',
                  borderColor: '{primary.color}',
                  hoverBorderColor: '{primary.color}',
                  activeBorderColor: '{primary.color}',
                  color: '{secondary.color}',
                  hoverColor: '{secondary.color}',
                  activeColor: '{secondary.color}',
                  focusRing: {
                     color: '{primary.color}',
                     shadow: 'none'
                  }
               },
               secondary: {
                  background: '{secondary.color}',
                  hoverBackground: '{secondary.hover.color}',
                  activeBackground: '{secondary.active.color}',
                  borderColor: '{secondary.color}',
                  hoverBorderColor: '{secondary.hover.color}',
                  activeBorderColor: '{secondary.active.color}',
                  color: '{slate.50}',
                  hoverColor: '{slate.50}',
                  activeColor: '{slate.50}',
                  focusRing: {
                     color: '{secondary.color}',
                     shadow: 'none'
                  }
               },
               info: {
                  background: '{sky.500}',
                  hoverBackground: '{sky.600}',
                  activeBackground: '{sky.700}',
                  borderColor: '{sky.500}',
                  hoverBorderColor: '{sky.600}',
                  activeBorderColor: '{sky.700}',
                  color: '#ffffff',
                  hoverColor: '#ffffff',
                  activeColor: '#ffffff',
                  focusRing: {
                     color: '{sky.500}',
                     shadow: 'none'
                  }
               },
               success: {
                  background: '{green.500}',
                  hoverBackground: '{green.600}',
                  activeBackground: '{green.700}',
                  borderColor: '{green.500}',
                  hoverBorderColor: '{green.600}',
                  activeBorderColor: '{green.700}',
                  color: '#ffffff',
                  hoverColor: '#ffffff',
                  activeColor: '#ffffff',
                  focusRing: {
                     color: '{green.500}',
                     shadow: 'none'
                  }
               },
               warn: {
                  background: '{yellow.500}',
                  hoverBackground: '{yellow.600}',
                  activeBackground: '{yellow.700}',
                  borderColor: '{yellow.500}',
                  hoverBorderColor: '{yellow.600}',
                  activeBorderColor: '{yellow.700}',
                  color: '#ffffff',
                  hoverColor: '#ffffff',
                  activeColor: '#ffffff',
                  focusRing: {
                     color: '{yellow.500}',
                     shadow: 'none'
                  }
               },
               help: {
                     background: '{purple.500}',
                     hoverBackground: '{purple.600}',
                     activeBackground: '{purple.700}',
                     borderColor: '{purple.500}',
                     hoverBorderColor: '{purple.600}',
                     activeBorderColor: '{purple.700}',
                     color: '#ffffff',
                     hoverColor: '#ffffff',
                     activeColor: '#ffffff',
                     focusRing: {
                        color: '{purple.500}',
                        shadow: 'none'
                     }
               },
               danger: {
                  background: '{red.500}',
                  hoverBackground: '{red.600}',
                  activeBackground: '{red.700}',
                  borderColor: '{red.500}',
                  hoverBorderColor: '{red.600}',
                  activeBorderColor: '{red.700}',
                  color: '#ffffff',
                  hoverColor: '#ffffff',
                  activeColor: '#ffffff',
                  focusRing: {
                     color: '{red.500}',
                     shadow: 'none'
                  }
               },
               contrast: {
                  background: '{surface.950}',
                  hoverBackground: '{surface.900}',
                  activeBackground: '{surface.800}',
                  borderColor: '{surface.950}',
                  hoverBorderColor: '{surface.900}',
                  activeBorderColor: '{surface.800}',
                  color: '{surface.0}',
                  hoverColor: '{surface.0}',
                  activeColor: '{surface.0}',
                  focusRing: {
                     color: '{surface.950}',
                     shadow: 'none'
                  }
               }
            },
            outlined: {
               primary: {
                  hoverBackground: '{primary.50}',
                  activeBackground: '{primary.100}',
                  borderColor: '{primary.500}',
                  color: '{primary.500}'
               },
               secondary: {
                  hoverBackground: '{secondary.50}',
                  activeBackground: '{secondary.100}',
                  borderColor: '{secondary.500}',
                  color: '{secondary.500}'
               },
               success: {
                  hoverBackground: '{green.50}',
                  activeBackground: '{green.100}',
                  borderColor: '{green.500}',
                  color: '{green.500}'
               },
               info: {
                  hoverBackground: '{sky.50}',
                  activeBackground: '{sky.100}',
                  borderColor: '{sky.500}',
                  color: '{sky.500}'
               },
               warn: {
                  hoverBackground: '{yellow.50}',
                  activeBackground: '{yellow.100}',
                  borderColor: '{yellow.500}',
                  color: '{yellow.500}'
               },
               help: {
                  hoverBackground: '{purple.50}',
                  activeBackground: '{purple.100}',
                  borderColor: '{purple.500}',
                  color: '{purple.500}'
               },
               danger: {
                  hoverBackground: '{red.50}',
                  activeBackground: '{red.100}',
                  borderColor: '{red.500}',
                  color: '{red.500}'
               },
               contrast: {
                  hoverBackground: '{surface.50}',
                  activeBackground: '{surface.100}',
                  borderColor: '{surface.700}',
                  color: '{surface.700}'
               },
            },
            text: {
               primary: {
                  hoverBackground: '{primary.50}',
                  activeBackground: '{primary.100}',
                  color: '{primary.color}'
               },
               secondary: {
                  hoverBackground: '{secondary.50}',
                  activeBackground: '{secondary.100}',
                  color: '{secondary.500}'
               },
               success: {
                  hoverBackground: '{green.50}',
                  activeBackground: '{green.100}',
                  color: '{green.500}'
               },
               info: {
                  hoverBackground: '{sky.50}',
                  activeBackground: '{sky.100}',
                  color: '{sky.500}'
               },
               warn: {
                  hoverBackground: '{yellow.50}',
                  activeBackground: '{yellow.100}',
                  color: '{yellow.500}'
               },
               help: {
                  hoverBackground: '{purple.50}',
                  activeBackground: '{purple.100}',
                  color: '{purple.500}'
               },
               danger: {
                  hoverBackground: '{red.50}',
                  activeBackground: '{red.100}',
                  color: '{red.500}'
               },
               contrast: {
                  hoverBackground: '{surface.50}',
                  activeBackground: '{surface.100}',
                  color: '{surface.950}'
               },
               plain: {
                  hoverBackground: '{surface.50}',
                  activeBackground: '{surface.100}',
                  color: '{surface.700}'
               }
            },
            link: {
               color: '{secondary.500}',
               hoverColor: '{secondary.500}',
               activeColor: '{secondary.500}',
            }
         },
         dark: {
            root: {
               primary: {
                  background: '{secondary.color}',
                  hoverBackground: '{primary.color}',
                  activeBackground: '{primary.active.color}',
                  borderColor: '{primary.color}',
                  hoverBorderColor: '{primary.color}',
                  activeBorderColor: '{primary.color}',
                  color: '{secondary.color}',
                  hoverColor: '{secondary.color}',
                  activeColor: '{secondary.color}',
                  focusRing: {
                     color: '{primary.color}',
                     shadow: 'none'
                  }
               },
               secondary: {
                  background: '{secondary.color}',
                  hoverBackground: '{secondary.hover.color}',
                  activeBackground: '{secondary.active.color}',
                  borderColor: '{secondary.color}',
                  hoverBorderColor: '{secondary.hover.color}',
                  activeBorderColor: '{secondary.active.color}',
                  color: '{slate.50}',
                  hoverColor: '{slate.50}',
                  activeColor: '{slate.50}',
                  focusRing: {
                     color: '{secondary.color}',
                     shadow: 'none'
                  }
               },
               info: {
                  background: '{sky.500}',
                  hoverBackground: '{sky.600}',
                  activeBackground: '{sky.700}',
                  borderColor: '{sky.500}',
                  hoverBorderColor: '{sky.600}',
                  activeBorderColor: '{sky.700}',
                  color: '#ffffff',
                  hoverColor: '#ffffff',
                  activeColor: '#ffffff',
                  focusRing: {
                     color: '{sky.500}',
                     shadow: 'none'
                  }
               },
               success: {
                  background: '{green.500}',
                  hoverBackground: '{green.600}',
                  activeBackground: '{green.700}',
                  borderColor: '{green.500}',
                  hoverBorderColor: '{green.600}',
                  activeBorderColor: '{green.700}',
                  color: '#ffffff',
                  hoverColor: '#ffffff',
                  activeColor: '#ffffff',
                  focusRing: {
                     color: '{green.500}',
                     shadow: 'none'
                  }
               },
               warn: {
                  background: '{yellow.500}',
                  hoverBackground: '{yellow.600}',
                  activeBackground: '{yellow.700}',
                  borderColor: '{yellow.500}',
                  hoverBorderColor: '{yellow.600}',
                  activeBorderColor: '{yellow.700}',
                  color: '#ffffff',
                  hoverColor: '#ffffff',
                  activeColor: '#ffffff',
                  focusRing: {
                     color: '{yellow.500}',
                     shadow: 'none'
                  }
               },
               help: {
                     background: '{purple.500}',
                     hoverBackground: '{purple.600}',
                     activeBackground: '{purple.700}',
                     borderColor: '{purple.500}',
                     hoverBorderColor: '{purple.600}',
                     activeBorderColor: '{purple.700}',
                     color: '#ffffff',
                     hoverColor: '#ffffff',
                     activeColor: '#ffffff',
                     focusRing: {
                        color: '{purple.500}',
                        shadow: 'none'
                     }
               },
               danger: {
                  background: '{red.500}',
                  hoverBackground: '{red.600}',
                  activeBackground: '{red.700}',
                  borderColor: '{red.500}',
                  hoverBorderColor: '{red.600}',
                  activeBorderColor: '{red.700}',
                  color: '#ffffff',
                  hoverColor: '#ffffff',
                  activeColor: '#ffffff',
                  focusRing: {
                     color: '{red.500}',
                     shadow: 'none'
                  }
               },
               contrast: {
                  background: '{surface.950}',
                  hoverBackground: '{surface.900}',
                  activeBackground: '{surface.800}',
                  borderColor: '{surface.950}',
                  hoverBorderColor: '{surface.900}',
                  activeBorderColor: '{surface.800}',
                  color: '{surface.0}',
                  hoverColor: '{surface.0}',
                  activeColor: '{surface.0}',
                  focusRing: {
                     color: '{surface.950}',
                     shadow: 'none'
                  }
               }
            },
            outlined: {
               primary: {
                  hoverBackground: '{primary.50}',
                  activeBackground: '{primary.100}',
                  borderColor: '{primary.500}',
                  color: '{primary.500}'
               },
               secondary: {
                  hoverBackground: '{secondary.50}',
                  activeBackground: '{secondary.100}',
                  borderColor: '{secondary.500}',
                  color: '{secondary.500}'
               },
               success: {
                  hoverBackground: '{green.50}',
                  activeBackground: '{green.100}',
                  borderColor: '{green.500}',
                  color: '{green.500}'
               },
               info: {
                  hoverBackground: '{sky.50}',
                  activeBackground: '{sky.100}',
                  borderColor: '{sky.500}',
                  color: '{sky.500}'
               },
               warn: {
                  hoverBackground: '{yellow.50}',
                  activeBackground: '{yellow.100}',
                  borderColor: '{yellow.500}',
                  color: '{yellow.500}'
               },
               help: {
                  hoverBackground: '{purple.50}',
                  activeBackground: '{purple.100}',
                  borderColor: '{purple.500}',
                  color: '{purple.500}'
               },
               danger: {
                  hoverBackground: '{red.50}',
                  activeBackground: '{red.100}',
                  borderColor: '{red.500}',
                  color: '{red.500}'
               },
               contrast: {
                  hoverBackground: '{surface.50}',
                  activeBackground: '{surface.100}',
                  borderColor: '{surface.700}',
                  color: '{surface.700}'
               },
            },
            text: {
               primary: {
                  hoverBackground: '{primary.50}',
                  activeBackground: '{primary.100}',
                  color: '{primary.color}'
               },
               secondary: {
                  hoverBackground: '{secondary.50}',
                  activeBackground: '{secondary.100}',
                  color: '{secondary.500}'
               },
               success: {
                  hoverBackground: '{green.50}',
                  activeBackground: '{green.100}',
                  color: '{green.500}'
               },
               info: {
                  hoverBackground: '{sky.50}',
                  activeBackground: '{sky.100}',
                  color: '{sky.500}'
               },
               warn: {
                  hoverBackground: '{yellow.50}',
                  activeBackground: '{yellow.100}',
                  color: '{yellow.500}'
               },
               help: {
                  hoverBackground: '{purple.50}',
                  activeBackground: '{purple.100}',
                  color: '{purple.500}'
               },
               danger: {
                  hoverBackground: '{red.50}',
                  activeBackground: '{red.100}',
                  color: '{red.500}'
               },
               contrast: {
                  hoverBackground: '{surface.50}',
                  activeBackground: '{surface.100}',
                  color: '{surface.950}'
               },
               plain: {
                  hoverBackground: '{surface.50}',
                  activeBackground: '{surface.100}',
                  color: '{surface.700}'
               }
            },
            link: {
               color: '{slate.50}',
               hoverColor: '{slate.50}',
               activeColor: '{slate.50}',
            }
         }
      }
   }
};

//PRESET DE THEMA
export const appTheme = definePreset(Aura, {
   components:{
      toolbar: appComponents.toolbar,
      breadcrumb: appComponents.breadcrumb,
      datatable: appComponents.datatable,
      inputtext: appComponents.inputtext,
      textarea: appComponents.textarea,
      select: appComponents.select,
      multiselect: appComponents.multiselect,
      dialog: appComponents.dialog,
      togglebutton: appComponents.togglebutton,
      button: appComponents.button,
   },
   semantic: {
      primary: appColors.primary,
      secondary: appColors.secondary,
      colorScheme: {
         light: {
            body:{
               background: '{slate.100}',
            },
            content: {
               background: '{fz-light.100}',
            },
            primary: {
               color: '{primary.500}',
               contrastColor: '{secondary.500}',
               hoverColor: '{primary.700}',
               activeColor: '{primary.500}'
            },
            secondary: {
               color: '{secondary.500}',
               contrastColor: '{slate.50}',
               hoverColor: '{secondary.700}',
               activeColor: '{secondary.500}'
            },
            highlight: {
               background: '{primary.500}',
               focusBackground: '{primary.700}',
               focusColor: '{primary.300}',
               color: '{fz-light.100}',
            },
            surface: appColors.surface,
         },
         dark: {
            body:{
               background: '{fz-dark.500}',
            },
            content: {
               background: '{fz-dark.700}',
            },
            primary: {
               color: '{primary.500}',
               contrastColor: '{secondary.500}',
               hoverColor: '{primary.700}',
               activeColor: '{primary.500}'
            },
            secondary: {
               color: '{secondary.500}',
               contrastColor: '{slate.50}',
               hoverColor: '{secondary.700}',
               activeColor: '{secondary.500}'
            },
            highlight: {
               background: '{primary.500}',
               focusBackground: '{primary.700}',
               focusColor: '{primary.300}',
               color: '{fz-light.100}'
            },
            surface: appColors.surface,
         }
      }
   }
});

export function useLayout() {
   //FUNÇÃO PARA ALTERAR TEMA
   function toggleTheme() {
      appState.value.darkMode = !appState.value.darkMode;
      document.documentElement.classList.toggle('harpia-theme');
   }

   // FUNÇÃO PARA ABRIR E FECHAR SIDEBAR
   function toggleSideBar() {
      appState.value.sidebarCollapsed = !appState.value.sidebarCollapsed;
   }

   //ESTADOS DE TEMA 
   const isDarkMode = computed(() => appState.value.darkMode);
   const isSidebarCollapsed = computed(() => appState.value.sidebarCollapsed);
   const primary = computed(() => appState.value.primary);

   return {
      isDarkMode,
      isSidebarCollapsed,
      primary,
      toggleTheme,
      toggleSideBar
   };
}