# -*- coding: utf-8 -*-
import pandas as pd
from matplotlib import pyplot as plt
import numpy as np
import math
from sklearn.preprocessing import LabelEncoder
from sklearn.discriminant_analysis import LinearDiscriminantAnalysis as LDA
from pprint import pprint


feature_dict = {i:label for i,label in zip(
                range(2),
                  ('DISTANCIA',
                  'POPULARIDADE',
                   ))}


df = pd.io.parsers.read_csv(
    filepath_or_buffer='teste.txt',
    header=None,
    sep=',',
    )


df.columns = [l for i,l in sorted(feature_dict.items())] + ['class label']
df.dropna(how="all", inplace=True) # to drop the empty line at file-end
df.tail()

positivos = []
negativos = []


X = df[['DISTANCIA','POPULARIDADE']].values
y = df['class label'].values


for i, classe in enumerate(y):
    if classe == "0":
        negativos.append(X[i])
    else:
        positivos.append(X[i])

positivos = np.asarray(positivos)
negativos = np.asarray(negativos)


enc = LabelEncoder()
label_encoder = enc.fit(y)



y = label_encoder.transform(y) + 1

label_dict = {1: 'Negativo', 2: 'Positivo'}


fig, axes = plt.subplots(nrows=2, ncols=2, figsize=(12,6))

for ax,cnt in zip(axes.ravel(), range(2)):  

    # set bin sizes
    min_b = math.floor(np.min(X[:,cnt]))
    max_b = math.ceil(np.max(X[:,cnt]))
    bins = np.linspace(min_b, max_b, 25)

    # plottling the histograms
    for lab,col in zip(range(1,3), ('blue', 'red')):
        ax.hist(X[y==lab, cnt],
                   color=col,
                   label='class %s' %label_dict[lab],
                   bins=bins,
                   alpha=0.5,)
    ylims = ax.get_ylim()

    # plot annotation
    leg = ax.legend(loc='upper right', fancybox=True, fontsize=8)
    leg.get_frame().set_alpha(0.5)
    ax.set_ylim([0, max(ylims)+2])
    ax.set_xlabel(feature_dict[cnt])
    ax.set_title('Histogram #%s' %str(cnt+1))

    # hide axis ticks
    ax.tick_params(axis="both", which="both", bottom="off", top="off",  
            labelbottom="on", left="off", right="off", labelleft="on")

    # remove axis spines
    ax.spines["top"].set_visible(False)  
    ax.spines["right"].set_visible(False)
    ax.spines["bottom"].set_visible(False)
    ax.spines["left"].set_visible(False)    

axes[0][0].set_ylabel('count')
axes[1][0].set_ylabel('count')

fig.tight_layout()       

plt.show()

np.set_printoptions(precision=4)

mean_vectors = []
for cl in range(1,3):
    mean_vectors.append(np.mean(X[y==cl], axis=0))
    print('Mean Vector class %s: %s\n' %(cl, mean_vectors[cl-1]))


cov_pos = np.cov(positivos, None, False)

cov_neg = np.cov(negativos, None, False)

cov_total = cov_pos + cov_neg

cov_total2 = (cov_pos*len(positivos) + cov_neg*len(negativos))/(len(positivos)+len(negativos))


inv_cov = np.linalg.inv(cov_total)

inv_cov2 = np.linalg.inv(cov_total2)

print inv_cov2


mean_pos = np.mean(positivos, axis=0)

mean_neg = np.mean(negativos, axis=0)

mean_total = mean_neg - mean_pos

w = np.matmul(inv_cov, mean_total)
w2 = np.matmul(inv_cov2, mean_total)

print "\n\n"
print w
print "\n\n"
print w2

